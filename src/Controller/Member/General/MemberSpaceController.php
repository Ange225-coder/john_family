<?php

    namespace App\Controller\Member\General;

    use App\Repository\MemberRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class MemberSpaceController extends AbstractController
    {
        public function __construct(
            private readonly MemberRepository $memberRepository
        ){}


        #[Route(path: '/member-space', name: 'member_space')]
        #[IsGranted('ROLE_MEMBER')]
        public function memberSpace(): Response
        {
            $allMembers = $this->memberRepository->findAll();

            // Filter members registered this month
            $membersOfThisMonth = $this->memberRepository->findMembersRegisteredThisMonth();

            return $this->render('member/general/memberSpace.html.twig', [
                'members_of_this_month_counter' => count($membersOfThisMonth),
                'all_members' => $allMembers
            ]);
        }
    }
