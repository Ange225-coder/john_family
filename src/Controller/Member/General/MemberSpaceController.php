<?php

    namespace App\Controller\Member\General;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class MemberSpaceController extends AbstractController
    {
        #[Route(path: '/member-space', name: 'member_space')]
        #[IsGranted('ROLE_MEMBER')]
        public function memberSpace(): Response
        {
            return $this->render('member/general/memberSpace.html.twig');
        }
    }
