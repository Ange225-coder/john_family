<?php

    namespace App\Controller\Member\Settings;

    use App\Entity\Member;
    use App\Form\Fields\Member\Settings\FirstNameFields;
    use App\Form\Fields\Member\Settings\LastNameFields;
    use App\Form\Fields\Member\Settings\ProfilePictureFields;
    use App\Form\Fields\Member\Settings\PseudonymeFields;
    use App\Form\Types\Member\Settings\FirstNameType;
    use App\Form\Types\Member\Settings\LastNameType;
    use App\Form\Types\Member\Settings\ProfilePictureType;
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

            $profilePictureFields = new ProfilePictureFields();

            $lastNameForm = $this->createForm(LastNameType::class, $lastNameFields);
            $firstNameForm = $this->createForm(FirstNameType::class, $firstNameFields);
            $pseudonymeForm = $this->createForm(PseudonymeType::class, $pseudonymeFields);
            $profilePictureForm = $this->createForm(ProfilePictureType::class, $profilePictureFields);

            $lastNameForm->handleRequest($request);
            $firstNameForm->handleRequest($request);
            $pseudonymeForm->handleRequest($request);
            $profilePictureForm->handleRequest($request);



            // Profil picture submit manager
            if ($profilePictureForm->isSubmitted() && $profilePictureForm->isValid()) {

                $newProfilPicture = $profilePictureFields->getProfilePicture();

                if ($newProfilPicture) {
                    $newProfilPictureName = uniqid().'.'.$newProfilPicture->guessExtension();
                    $newProfilPicture->move($this->getParameter('member_profile_pictures_dir'), $newProfilPictureName);

                    $member->setProfilePicture($newProfilPictureName);
                }

                $this->entityManager->flush();

                $this->addFlash('profil_pic_updated_successfully', 'Ta photo de profil été mis à jour avec succès');
                return $this->redirectToRoute('member_settings');
            }

            // Last name submit manager
            if ($lastNameForm->isSubmitted() && $lastNameForm->isValid()) {

                $member->setLastName($lastNameFields->getNewLastName());

                $this->entityManager->flush();

                $this->addFlash('last_name_updated_successfully', 'Ton nom a été mis à jour avec succès');
                return $this->redirectToRoute('member_settings');
            }

            // First name submit manager
            if ($firstNameForm->isSubmitted() && $firstNameForm->isValid()) {

                $member->setFirstName($firstNameFields->getNewFirstName());

                $this->entityManager->flush();

                $this->addFlash('first_name_updated_successfully', 'Ton prénom a été mis à jour avec succès');
                return $this->redirectToRoute('member_settings');
            }

            // Pseudonyme submit manager
            if ($pseudonymeForm->isSubmitted() && $pseudonymeForm->isValid()) {

                $member->setPseudonyme($pseudonymeFields->getNewPseudonyme());

                $this->entityManager->flush();

                $this->addFlash('pseudo_updated_successfully', 'Ton pseudonyme a été mis à jour avec succès');
                return $this->redirectToRoute('member_settings');
            }

            return $this->render('member/settings/memberSettings.html.twig', [
                'member' => $member,
                'last_name_form' => $lastNameForm->createView(),
                'first_name_form' => $firstNameForm->createView(),
                'pseudonyme_form' => $pseudonymeForm->createView(),
                'profile_picture_form' => $profilePictureForm->createView()
            ]);
        }
    }
