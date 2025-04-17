<?php

use MicroPHP\Contract\Enum\Attributes\EnumClass;
use MicroPHP\Contract\Enum\Attributes\EnumProperty;
use MicroPHP\Contract\Enum\EnumHelper;

test('enum label ', function () {
    expect(EnumA::A->label())->toBe('a');
});

test('enum labels ', function () {
    expect(EnumA::getLabels())->toBe(['a', 'b']);
});

test('enum list', function () {
    expect(EnumA::getList()[0]->toArray())->toBe(['code' => 'A', 'label' => 'a']);
});

test('enum map', function () {
    expect(EnumA::getMap())->toBe(['A' => 'a', 'B' => 'b']);
});

test('enum values', function () {
    expect(EnumA::getValues())->toBe(['A', 'B']);
});

test('enum has', function () {
    expect(EnumA::has('C'))->toBeFalse()
        ->and(EnumA::has('A'))->toBeTrue();
});

#[EnumClass(name: EnumA::class)]
enum EnumA: string
{
    use EnumHelper;

    #[EnumProperty(label: 'a')]
    case A = 'A';

    #[EnumProperty(label: 'b')]
    case B = 'B';
}