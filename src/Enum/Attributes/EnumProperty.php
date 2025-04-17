<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class EnumProperty
{
    public function __construct(
        public string $label,
    ) {}
}
