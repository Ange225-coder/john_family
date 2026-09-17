<?php

    namespace App\Controller\Admin\General;

    use App\Repository\MemberRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class DashboardController extends AbstractController
    {
        public function __construct(
            private readonly MemberRepository $memberRepository
        ){}


        #[Route(path: '/admin/dashboard', name: 'admin_dashboard')]
        #[IsGranted('ROLE_ADMIN')]
        public function dashboard(): Response
        {
            $allMembers =$this->memberRepository->findBy([]);

            // Filter members registered this month
            $membersOfThisMonth = $this->memberRepository->findMembersRegisteredThisMonth();

            return $this->render('admin/general/dashboard.html.twig', [
                'all_members' => $allMembers,
                'members_of_this_month_counter' => count($membersOfThisMonth),
            ]);
        }
    }
