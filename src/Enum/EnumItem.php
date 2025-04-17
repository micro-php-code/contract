<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum;

use ArrayAccess;
use MicroPHP\Contract\ArrayAble;

class EnumItem implements Arrayable, ArrayAccess
{
    use ArrayAccessTrait;

    public function __construct(
        public int|string $code,
        public string $label,
    ) {}

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'label' => $this->label,
        ];
    }
}
