<?php

declare(strict_types=1);

namespace MicroPHP\Contract\Enum;

trait EnumHelper
{
    /**
     * @return array<EnumItem>
     * @throws
     */
    public static function getList(): array
    {
        return EnumPropertyCollect::collect(static::class)->getList();
    }

    /**
     * 返回枚举值到枚举描述的映射
     * @return array<int|string, int|string>
     * @throws
     */
    public static function getMap(): array
    {
        return EnumPropertyCollect::collect(static::class)->getMap();
    }

    /**
     * @throws
     */
    public static function getValues(): array
    {
        return EnumPropertyCollect::collect(static::class)->getValues();
    }

    /**
     * @throws
     */
    public static function getLabels(): array
    {
        return array_values(EnumPropertyCollect::collect(static::class)->getMap());
    }

    /**
     * @throws
     */
    public static function getLabel(int|string $code): string
    {
        return static::getMap()[$code] ?? '';
    }

    /**
     * @throws
     */
    public static function has(int|string $code): bool
    {
        return isset(static::getMap()[$code]);
    }

    /**
     * @throws
     */
    public static function format(int|string $code): array
    {
        return [
            'label' => self::getLabel($code),
            'value' => $code,
        ];
    }

    /**
     * @throws
     */
    public function label(): string
    {
        return static::getLabel($this->value);
    }

    /**
     * @param array<static> $only
     * @param array<static> $except
     * @throws
     */
    public static function rule(array $only = [], array $except = []): string
    {
        $data = [];
        foreach ($only ? array_map(fn ($enum) => $enum->value, $only) : static::getValues() as $datum) {
            if (! in_array($datum, $except)) {
                $data[] = $datum;
            }
        }
        return 'in:' . implode(',', $data);
    }
}
