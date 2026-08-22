<?php

    namespace App\Controller\Admin\General;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;

    class AdminHomeController extends AbstractController
    {
        #[Route(path: '/b_o/home', name: 'admin_home')]
        public function adminHome(): Response
        {
            return $this->render('admin/general/adminHome.html.twig');
        }
    }
