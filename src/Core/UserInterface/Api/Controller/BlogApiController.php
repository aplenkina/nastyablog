<?php

namespace App\Core\UserInterface\Api\Controller;

use App\Core\Infrastructure\Repository\ArticleRepository;
use App\Core\UserInterface\Api\Request\ArticleRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/articles', methods: ['GET'])]
class BlogApiController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function getArticles(ArticleRequest $articlesRequest, ArticleRepository $repository): Response
    {
        $articles = $repository->findAll();

        return $this->json($articles);
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function getArticle(int $id, ArticleRepository $repository): Response
    {
        $articles = $repository->find($id);

        if (null === $articles) {
            throw new NotFoundHttpException('Article not found!');
        }

        return $this->json($articles);
    }
}
