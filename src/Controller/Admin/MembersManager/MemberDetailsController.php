<?php

    namespace App\Controller\Admin\MembersManager;

    use App\Repository\MemberRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class MemberDetailsController extends AbstractController
    {
        public function __construct(
            private readonly MemberRepository $memberRepository
        ){}


        #[Route(path: '/admin/member-details/{pseudonyme}', name: 'admin_member_details')]
        #[IsGranted('ROLE_ADMIN')]
        public function memberDetails(string $pseudonyme): Response
        {
            $currentMember = $this->memberRepository->findOneBy([
                'pseudonyme' => $pseudonyme
            ]);

            if (!$currentMember) {
                throw $this->createNotFoundException('Ce membre n\'existe pas ou a été retiré de la plateforme');
            }

            return $this->render('admin/memberManager/memberDetails.html.twig', [
                'current_member' => $currentMember
            ]);
        }
    }
