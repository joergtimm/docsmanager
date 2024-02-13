<?php

namespace App\DBAL;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EnumDocumentType extends Type
{
    public const ENUM_DOC_TYPE = 'enumdoctype';
    public const ID_SHOT = 'id_shot';
    public const ID_CARD_FRONT = 'id_card_front';
    public const ID_CARD_BACK = 'id_card_back';
    public const CONTRACT = 'contract';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return "ENUM('id_shot', 'id_card_front', 'id_card_back', 'contract')";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, array(self::ID_SHOT, self::ID_CARD_FRONT, self::ID_CARD_BACK, self::CONTRACT))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        return $value;
    }

    public function getName(): string
    {
        return self::ENUM_DOC_TYPE;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): true
    {
        return true;
    }
}