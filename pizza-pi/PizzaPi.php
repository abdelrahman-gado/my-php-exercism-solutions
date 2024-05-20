<?php

class PizzaPi
{
    const MIN_DOUGH = 200;
    const PERSON_DOUGH = 20;
    const PIZZA_SAUCE = 125;

    const PIZZA_SLICES = 8;
    public function calculateDoughRequirement(int $pizzasCount, int $personsCount): int
    {
        return $pizzasCount * (($personsCount * self::PERSON_DOUGH) + self::MIN_DOUGH);
    }

    public function calculateSauceRequirement(int $pizzasCount, int $sauceCanVolume): float
    {
        return ($pizzasCount * self::PIZZA_SAUCE) / $sauceCanVolume;
    }

    public function calculateCheeseCubeCoverage(float $cheeseDimension, float $thickness, float $diameter): int
    {
        return floor(($cheeseDimension ** 3) / ($thickness * pi() * $diameter));
    }

    public function calculateLeftOverSlices(int $pizzasCount, int $friendsCount): int
    {
        return ($pizzasCount * self::PIZZA_SLICES) % $friendsCount;
    }
}
