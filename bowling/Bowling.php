<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Game
{
    private array $rolls = [];
    private int $currentRoll = 0;
    private const PINS_COUNT = 10;

    private const DOUBLE_PINS_COUNT = 20;

    public function __construct()
    {
        $this->rolls = array_fill(0, 30, 0);
    }

    public function score(): int
    {
        $this->validateBeforeScore();

        $gameScore = 0;
        $frameIndex = 0;
        for ($frame = 0; $frame < self::PINS_COUNT; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $gameScore += self::PINS_COUNT + $this->strikeBonus($frameIndex);
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                $gameScore += self::PINS_COUNT + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $frameScore = $this->sumOfBallsInFrame($frameIndex);
                $gameScore += $frameScore;
                $frameIndex += 2;
            }
        }

        return $gameScore;
    }

    private function validateBeforeScore(): void
    {
        if (
            $this->currentRoll <= 0 ||
            $this->currentRoll < 10 ||
            ($this->currentRoll > self::DOUBLE_PINS_COUNT && $this->rolls[19] == 0) ||
            $this->currentRoll === 19 && $this->rolls[18] === self::PINS_COUNT && $this->rolls[19] !== self::PINS_COUNT ||
            $this->currentRoll === self::DOUBLE_PINS_COUNT && $this->rolls[18] === self::PINS_COUNT && $this->rolls[19] === self::PINS_COUNT ||
            $this->currentRoll === self::DOUBLE_PINS_COUNT && ($this->rolls[18] + $this->rolls[19] === self::PINS_COUNT) && !$this->rolls[self::DOUBLE_PINS_COUNT]
        ) {
            throw new Exception();
        }
    }

    public function roll(int $pins): void
    {
        $this->validateRollValue($pins);
        $this->rolls[$this->currentRoll] = $pins;
        $this->currentRoll++;
    }

    private function validateRollValue(int $pins): void
    {
        if ($pins < 0 || $pins > 10) {
            throw new Exception();
        }
    }

    private function isStrike(int $frameIndex): bool
    {
        return $this->rolls[$frameIndex] === self::PINS_COUNT;
    }

    private function isSpare(int $frameIndex): bool
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] === self::PINS_COUNT;
    }

    private function sumOfBallsInFrame(int $frameIndex): int
    {
        $sum = $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
        if ($sum > self::PINS_COUNT) {
            throw new Exception();
        }

        return $sum;
    }

    private function spareBonus(int $frameIndex): int
    {
        return $this->rolls[$frameIndex + 2];
    }

    private function strikeBonus(int $frameIndex): int
    {
        $bonus = $this->rolls[$frameIndex + 1] + $this->rolls[$frameIndex + 2];
        if (
            $bonus > self::PINS_COUNT
            && $frameIndex + 2 === self::DOUBLE_PINS_COUNT
            && $this->rolls[$frameIndex + 2] !== self::PINS_COUNT
        ) {
            throw new Exception();
        }

        return $bonus;
    }
}
