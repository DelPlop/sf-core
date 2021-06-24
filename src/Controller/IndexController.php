<?php

namespace DelPlop\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@DelPlopUser/index/index.html.twig', [
            'activePage' => 'home'
        ]);
    }
}
