<?php

    namespace App\Controller\Member\RegisterAndAuth;

    use App\Form\Fields\Member\RegisterAndAuth\RegistrationStepOneFields;
    use App\Form\Types\Member\RegisterAndAuth\RegistrationStepOneType;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\HttpFoundation\Response;

    class MemberRegistrationStepOneController extends AbstractController
    {
        #[Route(path: '/registration/step-1', name: 'member_registration_step_one')]
        public function registrationStepOne(Request $request): Response
        {
            $registrationStepOneFields = new RegistrationStepOneFields();

            $registrationForm = $this->createForm(RegistrationStepOneType::class, $registrationStepOneFields);
            $registrationForm->handleRequest($request);

            if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
                $session = $request->getSession();

                $session->set('last_name', $registrationStepOneFields->getLastName());
                $session->set('first_name', $registrationStepOneFields->getFirstName());

                return $this->redirectToRoute('member_registration_step_two');
            }

            return $this->render('member/registerAndAuth/memberRegistrationStepOne.html.twig', [
                'registration_step_one_form' => $registrationForm->createView()
            ]);
        }
    }
