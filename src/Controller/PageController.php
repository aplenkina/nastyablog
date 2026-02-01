<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        $startNumber = 456;
        return $this->render('page/homepage.html.twig', ['startNumber' => $startNumber]);

    }
}
