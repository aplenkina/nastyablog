<?php

namespace App\Core\UserInterface\Api\Request;

use Symfony\Component\Validator\Constraints as SymfonyAssert;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class ArticleRequest implements RequestInterface
{
    #[SymfonyAssert\Sequentially([
        new NotNull(),
        new Type('string'),
        new Length(min: 0, max: 255),
    ])]
    public mixed $name = '';

}
