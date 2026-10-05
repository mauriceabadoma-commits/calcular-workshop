<?php

declare(strict_types=1);

namespace App;

use InvalidArgumentException;

/**
 * Calculatrice sécurisée (version corrigée après analyse SonarQube).
 */
class Calculator
{
    public function addition(int|float $a, int|float $b): int|float
    {
        return $a + $b;
    }

    public function subtraction(int|float $a, int|float $b): int|float
    {
        return $a - $b;
    }

    public function multiplication(int|float $a, int|float $b): int|float
    {
        return $a * $b;
    }

    /**
     * @throws InvalidArgumentException si $b vaut 0
     */
    public function division(int|float $a, int|float $b): int|float
    {
        if ($b == 0) {
            throw new InvalidArgumentException('Division par zéro impossible.');
        }

        return $a / $b;
    }

    /**
     * @throws InvalidArgumentException si $a est négatif
     */
    public function squareRoot(int|float $a): float
    {
        if ($a < 0) {
            throw new InvalidArgumentException('Racine carrée d\'un nombre négatif impossible.');
        }

        return sqrt($a);
    }

    public function power(int|float $a, int|float $b): int|float
    {
        return $a ** $b;
    }

    // unsafeEval() SUPPRIMÉE : eval() permet l'exécution de code arbitraire (injection).
}
