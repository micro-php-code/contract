<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class EnumClass
{
    public function __construct(
        public string $name,
        public string $description = '',
    ) {}
}
