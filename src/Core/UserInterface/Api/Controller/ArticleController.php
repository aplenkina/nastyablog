<?php

namespace App\Core\UserInterface\Api\Controller;

use App\Core\Infrastructure\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles/{id<\d+>}', name: 'app_article_show', methods: ['GET'])]
    public function show(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);

        if (null === $article) {
            throw $this->createNotFoundException('Article not found.');
        }

        return $this->render('article/show.html.twig', ['article' => $article]);
    }
}
