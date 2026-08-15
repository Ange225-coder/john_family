<?php

    namespace App\Controller\Home;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class HomeController extends AbstractController
    {
        public function home(): Response
        {
            return $this->render('public/home.html.twig');
        }
    }
