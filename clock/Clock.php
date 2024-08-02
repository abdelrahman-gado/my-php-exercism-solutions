<?php
declare(strict_types=1);

class Clock
{
    private const HOURS_IN_A_DAY = 24;
    private const MINUTES_IN_AN_HOUR = 60;

    public function __construct(
        private int $hours,
        private int $minutes = 0
    ) {
        $this->normalizeTime();
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

    private function normalizeMinutes(): void
    {
        $totalMinutes = $this->hours * self::MINUTES_IN_AN_HOUR + $this->minutes;
        $normalizedMinutes = $totalMinutes % (self::HOURS_IN_A_DAY * self::MINUTES_IN_AN_HOUR);

        if ($normalizedMinutes < 0) {
            $normalizedMinutes += self::HOURS_IN_A_DAY * self::MINUTES_IN_AN_HOUR;
        }

        $this->hours = intdiv($normalizedMinutes, self::MINUTES_IN_AN_HOUR);
        $this->minutes = $normalizedMinutes % self::MINUTES_IN_AN_HOUR;
    }

    private function normalizeTime(): void
    {
        $this->normalizeMinutes();
    }

    public function __toString(): string
    {
        $this->normalizeTime();
        return sprintf("%02d:%02d", $this->hours, $this->minutes);
    }
}
