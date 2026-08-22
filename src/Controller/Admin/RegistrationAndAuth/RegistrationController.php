<?php

    namespace App\Controller\Admin\RegistrationAndAuth;

    use App\Entity\Admin;
    use App\Form\Fields\Admin\RegisterAndAuth\RegistrationFields;
    use App\Form\Types\Admin\RegisterAndAuth\RegistrationType;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
    use Symfony\Component\Routing\Attribute\Route;

    class RegistrationController extends AbstractController
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager,
            private readonly UserPasswordHasherInterface $passwordHasher
        ){}


        #[Route(path: '/b_o/registation', name: 'admin_registration')]
        public function adminRegistration(Request $request): Response
        {
            $registrationFields = new RegistrationFields();
            $adminEntity = new Admin();

            $registrationForm = $this->createForm(RegistrationType::class, $registrationFields);
            $registrationForm->handleRequest($request);

            if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

                $adminEntity->setAdminName($registrationFields->getAdminName());
                $adminEntity->setPassword($this->passwordHasher->hashPassword($adminEntity, $registrationFields->getPassword()));

                $this->entityManager->persist($adminEntity);
                $this->entityManager->flush();

                return $this->redirectToRoute('admin_home');
            }

            return $this->render('admin/registerAndAuth/adminRegistration.html.twig', [
                'admin_registration_form' => $registrationForm
            ]);
        }
    }
