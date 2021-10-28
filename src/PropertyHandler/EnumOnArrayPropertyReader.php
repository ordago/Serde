<?php

declare(strict_types=1);

namespace Crell\Serde\PropertyHandler;

use Crell\Serde\Field;
use Crell\Serde\Formatter\Deformatter;

class EnumOnArrayPropertyReader extends EnumPropertyReader
{
    public function writeValue(Deformatter $formatter, callable $recursor, Field $field, mixed $source): mixed
    {
        if ($source[$field->serializedName] ?? null instanceof \UnitEnum) {
            return $source[$field->serializedName];
        }
        return parent::writeValue($formatter, $recursor, $field, $source);
    }

    public function canWrite(Field $field, string $format): bool
    {
        return $field->typeCategory->isEnum() && $format === 'array';
    }
}