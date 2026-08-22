<?php

    namespace App\Controller\Admin\MembersManager;

    use App\Repository\MemberRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class MembersListController extends AbstractController
    {
        public function __construct(
            private readonly MemberRepository $memberRepository
        ){}


        #[Route(path: '/admin/members-list', name: 'admin_members_list')]
        #[IsGranted('ROLE_ADMIN')]
        public function membersList(): Response
        {
            $members = $this->memberRepository->findAll();

            return $this->render('admin/memberManager/membersList.html.twig', [
                'members' => $members
            ]);
        }
    }
