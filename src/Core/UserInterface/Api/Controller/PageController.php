<?php

namespace App\Core\UserInterface\Api\Controller;

use App\Core\Infrastructure\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(ArticleRepository $repository): Response
    {
        $articles = $repository->findAll();

        return $this->render('page/homepage.html.twig', ['articles' => $articles]);
    }

    #[Route('/diary', name: 'diary')]
    public function diary(): Response
    {
        return $this->render('page/diary.html.twig');
    }
}
