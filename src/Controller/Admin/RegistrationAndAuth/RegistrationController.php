<?php

    namespace App\Controller\Admin\RegistrationAndAuth;

    use App\Entity\Admin;
    use App\Form\Fields\Admin\RegisterAndAuth\RegistrationFields;
    use App\Form\Types\Admin\RegisterAndAuth\RegistrationType;
    use App\Security\AdminAuthenticator;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

    class RegistrationController extends AbstractController
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager,
            private readonly UserPasswordHasherInterface $passwordHasher,
            private readonly UserAuthenticatorInterface $authenticator,
            private readonly AdminAuthenticator $adminAuthenticator
        ){}


        #[Route(path: '/b_o/registation', name: 'admin_registration')]
        public function adminRegistration(Request $request): Response
        {
            if ($this->getUser()) {
                return $this->redirectToRoute('admin_dashboard');
            }

            $registrationFields = new RegistrationFields();
            $adminEntity = new Admin();

            $registrationForm = $this->createForm(RegistrationType::class, $registrationFields);
            $registrationForm->handleRequest($request);

            if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

                $adminEntity->setAdminName($registrationFields->getAdminName());
                $adminEntity->setPassword($this->passwordHasher->hashPassword($adminEntity, $registrationFields->getPassword()));

                $this->entityManager->persist($adminEntity);
                $this->entityManager->flush();

                // Authenticate admin
                try {
                    $response = $this->authenticator->authenticateUser($adminEntity, $this->adminAuthenticator, $request);

                    return $response ?? $this->redirectToRoute('admin_dashboard');
                }
                catch (AuthenticationException $e) {
                    $this->addFlash('authentication_error', 'Votre compte a été créé, mais la connexion automatique a échoué. Veuillez vous connecter.');

                    return $this->redirectToRoute('admin_login');
                }
            }

            return $this->render('admin/registerAndAuth/adminRegistration.html.twig', [
                'admin_registration_form' => $registrationForm
            ]);
        }
    }
