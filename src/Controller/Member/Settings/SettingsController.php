<?php

    namespace App\Controller\Member\Settings;

    use App\Entity\Member;
    use App\Repository\MemberRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class SettingsController extends AbstractController
    {
        public function __construct(
            private readonly EntityManagerInterface $entityManager,
            private readonly MemberRepository $memberRepository
        ){}


        #[Route(path: '/settings', name: 'member_settings')]
        #[IsGranted('ROLE_MEMBER')]
        public function settings(): Response
        {
            $member = $this->getUser();

            if (!$member instanceof Member) {
                throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette page');
            }

            return $this->render('member/settings/memberSettings.html.twig', [
                'member' => $member
            ]);
        }
    }
