<?php

    namespace App\Controller\Member\Settings;

    use App\Entity\Member;
    use App\Form\Fields\Member\Settings\FirstNameFields;
    use App\Form\Fields\Member\Settings\LastNameFields;
    use App\Form\Fields\Member\Settings\PseudonymeFields;
    use App\Form\Types\Member\Settings\FirstNameType;
    use App\Form\Types\Member\Settings\LastNameType;
    use App\Form\Types\Member\Settings\PseudonymeType;
    use App\Repository\MemberRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class SettingsController extends AbstractController
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager
        ){}


        #[Route(path: '/settings', name: 'member_settings')]
        #[IsGranted('ROLE_MEMBER')]
        public function settings(Request $request): Response
        {
            $member = $this->getUser();

            if (!$member instanceof Member) {
                throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette page');
            }

            $lastNameFields = new LastNameFields();
            $lastNameFields->setCurrentLastName($member->getLastName());

            $firstNameFields = new FirstNameFields();
            $firstNameFields->setCurrentFirstName($member->getFirstName());

            $pseudonymeFields = new PseudonymeFields();
            $pseudonymeFields->setCurrentPseudonyme($member->getPseudonyme());

            $lastNameForm = $this->createForm(LastNameType::class, $lastNameFields);
            $firstNameForm = $this->createForm(FirstNameType::class, $firstNameFields);
            $pseudonymeForm = $this->createForm(PseudonymeType::class, $pseudonymeFields);

            $lastNameForm->handleRequest($request);
            $firstNameForm->handleRequest($request);
            $pseudonymeForm->handleRequest($request);

            // Last name submit manager
            if ($lastNameForm->isSubmitted() && $lastNameForm->isValid()) {

                $member->setLastName($lastNameFields->getNewLastName());

                $this->entityManager->flush();

                $this->addFlash('information_saved', 'Information mise à jour');
                return $this->redirectToRoute('home');
            }

            // First name submit manager
            if ($firstNameForm->isSubmitted() && $firstNameForm->isValid()) {

                $member->setFirstName($firstNameFields->getNewFirstName());

                $this->entityManager->flush();

                $this->addFlash('information_saved', 'Information mise à jour');
                return $this->redirectToRoute('home');
            }

            // Pseudonyme submit manager
            if ($pseudonymeForm->isSubmitted() && $pseudonymeForm->isValid()) {

                $member->setPseudonyme($pseudonymeFields->getNewPseudonyme());

                $this->entityManager->flush();

                $this->addFlash('information_saved', 'Information mise à jour');
                return $this->redirectToRoute('home');
            }

            return $this->render('member/settings/memberSettings.html.twig', [
                'member' => $member,
                'last_name_form' => $lastNameForm->createView(),
                'first_name_form' => $firstNameForm->createView(),
                'pseudonyme_form' => $pseudonymeForm->createView()
            ]);
        }
    }
