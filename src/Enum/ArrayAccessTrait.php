<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum;

trait ArrayAccessTrait
{
    public function offsetExists($offset): bool
    {
        return isset($this->{$offset});
    }

    public function offsetGet($offset): mixed
    {
        return $this->{$offset};
    }

    public function offsetSet($offset, $value): void
    {
        $this->{$offset} = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->{$offset});
    }
}
