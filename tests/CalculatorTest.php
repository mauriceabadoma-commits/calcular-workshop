<?php

declare(strict_types=1);

namespace Tests;

use App\Calculator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    private Calculator $calc;

    protected function setUp(): void
    {
        $this->calc = new Calculator();
    }

    // ---------- Exercice 1 : tests unitaires ----------

    #[DataProvider('additionProvider')]
    public function testAddition(int|float $a, int|float $b, int|float $expected): void
    {
        $this->assertEquals($expected, $this->calc->addition($a, $b));
    }

    public static function additionProvider(): array
    {
        return [
            'positifs' => [2, 3, 5],
            'négatifs' => [-2, -3, -5],
            'mixte'    => [-2, 5, 3],
            'zéro'     => [0, 0, 0],
            'décimaux' => [0.5, 0.25, 0.75],
        ];
    }

    #[DataProvider('subtractionProvider')]
    public function testSubtraction(int|float $a, int|float $b, int|float $expected): void
    {
        $this->assertEquals($expected, $this->calc->subtraction($a, $b));
    }

    public static function subtractionProvider(): array
    {
        return [
            'positifs' => [5, 3, 2],
            'négatif'  => [3, 5, -2],
            'zéro'     => [4, 0, 4],
        ];
    }

    #[DataProvider('multiplicationProvider')]
    public function testMultiplication(int|float $a, int|float $b, int|float $expected): void
    {
        $this->assertEquals($expected, $this->calc->multiplication($a, $b));
    }

    public static function multiplicationProvider(): array
    {
        return [
            'positifs'       => [3, 4, 12],
            'par zéro'       => [7, 0, 0],
            'signes opposés' => [-3, 4, -12],
            'deux négatifs'  => [-3, -4, 12],
        ];
    }

    // ---------- Exercice 2 : tests complémentaires pour la couverture ----------

    public function testSquareRoot(): void
    {
        $this->assertSame(4.0, $this->calc->squareRoot(16));
        $this->assertSame(0.0, $this->calc->squareRoot(0));
    }

    public function testSquareRootOfNegativeThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calc->squareRoot(-1);
    }

    public function testPower(): void
    {
        $this->assertEquals(8, $this->calc->power(2, 3));
        $this->assertEquals(1, $this->calc->power(5, 0));
    }

    // ---------- Exercice 3 : TDD sur division ----------

    public function testDivision(): void
    {
        $this->assertEquals(5, $this->calc->division(10, 2));
        $this->assertEquals(2.5, $this->calc->division(5, 2));
        $this->assertEquals(-5, $this->calc->division(10, -2));
    }

    public function testDivisionByZeroThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Division par zéro impossible.');
        $this->calc->division(10, 0);
    }

    // ---------- Exercice 4 : non-régression sécurité ----------

    public function testUnsafeEvalNoLongerExists(): void
    {
        $this->assertFalse(method_exists($this->calc, 'unsafeEval'));
    }
}
