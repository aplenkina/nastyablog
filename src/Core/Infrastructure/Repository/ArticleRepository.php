<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Article;

class ArticleRepository
{
    public function findAll(): array
    {
        return [
            new Article(
                1,
                'My life',
                'About the most important things in my life.',
                'anonymous'
            ),
            new Article(
                2,
                'Daily things',
                'Rituals make us happy.',
                'A.N.'
            ),
            new Article(
                3,
                'Communication',
                'We have lost something beautiful.',
                'A.A.D.'
            ),
        ];
    }

    public function find(int $id): ?Article
    {
        foreach ($this->findAll() as $article) {
            if ($article->getId() === $id) {
                return $article;
            }
        }

        return null;
    }
}
