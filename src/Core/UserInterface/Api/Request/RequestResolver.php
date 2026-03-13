<?php

declare(strict_types=1);

namespace App\Core\UserInterface\Api\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class RequestResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!is_subclass_of($argument->getType(), RequestInterface::class)) {
            return [];
        }

        try {
            $object = $this->serializer->deserialize(
                json_encode($request->query->all()),
                $argument->getType(),
                JsonEncoder::FORMAT,
            );
        } catch (NotEncodableValueException|NotNormalizableValueException $e) {
            $type = $argument->getType();

            $object = $type ? new ($type) : throw $e;
        }

        $this->validate($object);

        yield $object;
    }

    private function validate(object $payload): void
    {
        $violations = new ConstraintViolationList();

        $violations->addAll($this->validator->validate($payload));

        if (\count($violations)) {
            throw new ValidationFailedException($payload, $violations);
        }
    }
}
