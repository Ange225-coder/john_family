<?php

    namespace App\Controller\Member\RegisterAndAuth;

    use App\Entity\Member;
    use App\Form\Fields\Member\RegisterAndAuth\RegistrationStepTwoFields;
    use App\Form\Types\Member\RegisterAndAuth\RegistrationStepTwoType;
    use App\Security\MemberAuthenticator;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

    class RegistrationStepTwoController extends AbstractController
    {
        public function __construct(
            private readonly UserPasswordHasherInterface $passwordHasher,
            private readonly EntityManagerInterface $entityManager,
            private readonly UserAuthenticatorInterface $authenticator,
            private readonly MemberAuthenticator $memberAuthenticator
        ){}


        #[Route(path: '/registration/step-2', name: 'member_registration_step_two')]
        public function registrationStepTwo(Request $request): Response
        {
            $session = $request->getSession();

            // If session does not exist, redirect to step one
            if (empty($session->get('last_name')) || empty($session->get('first_name'))) {
                return $this->redirectToRoute('member_registration_step_one');
            }

            $lastName = $session->get('last_name');
            $firstName = $session->get('first_name');

            $registrationStepTwoFields = new RegistrationStepTwoFields();
            $memberEntity = new Member();

            $registrationForm = $this->createForm(RegistrationStepTwoType::class, $registrationStepTwoFields);
            $registrationForm->handleRequest($request);

            if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

                $memberEntity->setFirstName($firstName);
                $memberEntity->setLastName($lastName);
                $memberEntity->setPseudonyme($registrationStepTwoFields->getPseudonyme());
                $memberEntity->setPassword($this->passwordHasher->hashPassword($memberEntity, $registrationStepTwoFields->getPassword()));
                $memberEntity->setCreatedAt(new \DateTimeImmutable());

                // ProfilPicture manager
                $profilePicture = $registrationStepTwoFields->getProfilePicture();

                if ($profilePicture) {
                    $profilePictureName = uniqid().'.'.$profilePicture->guessExtension();
                    $profilePicture->move($this->getParameter('member_profile_pictures_dir'), $profilePictureName);

                    $memberEntity->setProfilePicture($profilePictureName);
                }

                $this->entityManager->persist($memberEntity);
                $this->entityManager->flush();

                // Authenticate member
                try {
                    $response = $this->authenticator->authenticateUser($memberEntity, $this->memberAuthenticator, $request);

                    // remove sessions variables
                    $session->remove('last_name');
                    $session->remove('first_name');

                    return $response ?? $this->redirectToRoute('member_space');
                }
                catch (AuthenticationException $e) {
                    $this->addFlash('authentication_error', 'Votre compte a été créé, mais la connexion automatique a échoué. Veuillez vous connecter.');

                    return $this->redirectToRoute('member_login');
                }
            }

            return $this->render('member/registerAndAuth/registrationStepTwo.html.twig', [
                'registration_step_two_form' => $registrationForm->createView()
            ]);
        }
    }
