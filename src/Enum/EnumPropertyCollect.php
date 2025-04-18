<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum;

use MicroPHP\Contract\Enum\Attributes\EnumClass;
use MicroPHP\Contract\Enum\Attributes\EnumProperty;
use ReflectionClass;
use ReflectionException;

class EnumPropertyCollect
{
    private string $enumName = '';

    private static array $cache = [];

    private array $enumMap = [];

    /**
     * @throws ReflectionException
     */
    public static function collect(string $class): self
    {
        if (isset(static::$cache[$class])) {
            return static::$cache[$class];
        }
        $map = [];
        $reflectionClass = new ReflectionClass($class);
        if (method_exists($reflectionClass, 'isEnum')) {
            $isEnumClass = $reflectionClass->isEnum();
        } else {
            $isEnumClass = false;
        }

        foreach ($reflectionClass->getReflectionConstants() as $constant) {
            $attributes = $constant->getAttributes(EnumProperty::class);
            foreach ($attributes as $attribute) {
                /** @var EnumProperty $enumAttribute */
                $enumAttribute = $attribute->newInstance();
                $value = $isEnumClass ? $constant->getValue()->value : $constant->getValue();
                $map[$value] = [
                    'label' => $enumAttribute->label,
                ];
            }
        }
        $instance = new self();
        $instance->enumMap = $map;
        $instance->collectClassAttribute($reflectionClass);

        return static::$cache[$class] = $instance;
    }

    public function getEnumName(): string
    {
        return $this->enumName;
    }

    /**
     * @return array<int|string, int|string>
     */
    public function getMap(): array
    {
        $map = [];
        foreach ($this->enumMap as $value => $item) {
            $map[$value] = $item['label'];
        }

        return $map;
    }

    /**
     * @return array<EnumItem>
     */
    public function getList(): array
    {
        $result = [];
        foreach ($this->enumMap as $value => $item) {
            $result[] = new EnumItem($value, $item['label']);
        }

        return $result;
    }

    public function getValues(): array
    {
        return array_keys($this->enumMap);
    }

    private function collectClassAttribute(ReflectionClass $reflectionClass): void
    {
        $attributes = $reflectionClass->getAttributes(EnumClass::class);
        if (count($attributes) === 0) {
            return;
        }
        /** @var EnumClass $instance */
        $instance = $attributes[0]->newInstance();
        $this->enumName = $instance->name;
    }
}
