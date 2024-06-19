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

class Clock
{
    public const DAY_HOURS = 24;
    public const DAY_MINUTES = 60;
    
    public function __construct(
        public int $hours,
        public int $minutes = 0
    ) {
        $this->reformat();
    }

    public function add(int $minutes): self
    {
        $this->minutes += $minutes;
        return $this;
    }

    public function sub(int $minutes): self
    {
        $this->minutes -= $minutes;
        return $this;
    }

    public function formatMinutes(): void
    {
        if ($this->minutes >= self::DAY_MINUTES) {
            $this->hours += (intdiv($this->minutes, self::DAY_MINUTES) % self::DAY_HOURS);
            $this->hours %= self::DAY_HOURS;
            $this->minutes %= self::DAY_MINUTES;
        }

        if ($this->minutes < 0) {
            $tempMinutes = (int) abs($this->minutes);
            if ($tempMinutes >= self::DAY_MINUTES) {
                if ($this->hours == 0) {
                    $this->hours = self::DAY_HOURS;
                }
                $this->hours -= (intdiv($tempMinutes, self::DAY_MINUTES) % self::DAY_HOURS);
                $this->hours %= self::DAY_HOURS;
                if ($tempMinutes % self::DAY_MINUTES > 0) {
                    if ($this->hours == 0) {
                        $this->hours = self::DAY_HOURS;
                    }
                    $this->hours--;
                    $this->hours %= self::DAY_HOURS;
                    $this->minutes = self::DAY_MINUTES - ($tempMinutes % self::DAY_MINUTES);
                }
            } else {
                if ($this->hours == 0) {
                    $this->hours = self::DAY_HOURS;
                }
                $this->hours--;
                $this->hours %= self::DAY_HOURS;
                $this->minutes = self::DAY_MINUTES - $tempMinutes;
            }
        }
    }

    public function formatHours(): void
    {
        if ($this->hours >= self::DAY_HOURS) {
            $this->hours %= self::DAY_HOURS;
        }

        if ($this->hours < 0) {
            $this->hours = self::DAY_HOURS - (((int) abs($this->hours)) % self::DAY_HOURS);
        }
    }

    public function reformat(): void
    {
        $this->formatMinutes();
        $this->formatHours();
    }

    public function __toString(): string
    {
        $this->reformat();
        $clock = sprintf("%02d:%02d", $this->hours, $this->minutes);
        return $clock;
    }
}