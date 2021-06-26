<?php

namespace DelPlop\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class IndexController extends AbstractController
{
    public function index(Environment $twig, Security $security): Response
    {
        return $this->render('index/index.html.twig', [
            'activePage' => 'home'
        ]);
    }
}
