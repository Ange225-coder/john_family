<?php

    namespace App\Controller\Admin\General;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Component\Security\Http\Attribute\IsGranted;

    class DashboardController extends AbstractController
    {
        #[Route(path: '/admin/dashboard', name: 'admin_dashboard')]
        #[IsGranted('ROLE_ADMIN')]
        public function dashboard(): Response
        {
            return $this->render('admin/general/dashboard.html.twig');
        }
    }
