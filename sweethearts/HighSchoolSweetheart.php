<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        return trim($name)[0];
    }

    public function initial(string $name): string
    {
        return strtoupper($this->firstLetter($name)) . '.';
    }

    public function initials(string $name): string
    {
        [$firstName, $lastName] = explode(' ', $name);
        return $this->initial($firstName) . ' ' . $this->initial($lastName);
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        $heart = <<<EXPECTED_HEART
                 ******       ******
               **      **   **      **
             **         ** **         **
            **            *            **
            **                         **
            **     {$this->initials($sweetheart_a)}  +  {$this->initials($sweetheart_b)}     **
             **                       **
               **                   **
                 **               **
                   **           **
                     **       **
                       **   **
                         ***
                          *
            EXPECTED_HEART;

        return $heart;
    }
}
