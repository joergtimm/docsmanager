<?php

namespace App\Identifier;

use ApiPlatform\Api\UriVariableTransformerInterface;
use ApiPlatform\Exception\InvalidUriVariableException;
use Symfony\Component\Uid\Uuid;

class UuidUriVariableTransformer implements UriVariableTransformerInterface
{
    /**
     * Transforms a uri variable value.
     *
     * @param mixed $value   The uri variable value to transform
     * @param array $types   The guessed type behind the uri variable
     * @param array $context Options available to the transformer
     *

     */
    public function transform(mixed $value, array $types, array $context = []): mixed
    {
        return Uuid::fromString($value);
    }

    /**
     * Checks whether the given uri variable is supported for transformation by this transformer.
     *
     * @param mixed $value   The uri variable value to transform
     * @param array $types   The types to which the data should be transformed
     * @param array $context Options available to the transformer
     */
    public function supportsTransformation(mixed $value, array $types, array $context = []): bool
    {
        foreach ($types as $type) {
            if (is_a($type, Uuid::class, true)) {
                return true;
            }
        }

        return false;
    }
}
