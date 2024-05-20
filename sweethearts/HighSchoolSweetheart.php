<?php

class HighSchoolSweetheart
{
  private function mb_trim($string, $trim_chars = '\s')
  {
    return preg_replace('/^[' . $trim_chars . ']*(?U)(.*)[' . $trim_chars . ']*$/u', '\\1', $string);
  }

  public function firstLetter(string $name): string
  {
    return $this->mb_trim($name)[0];
  }

  public function initial(string $name): string
  {
    return mb_strtoupper($this->firstLetter($name)) . '.';
  }

  public function initials(string $name): string
  {
    [$firstName, $lastName] = explode(' ', $name);
    return $this->initial($firstName) . ' ' . $this->initial($lastName);
  }

  public function pair(string $sweetheart_a, string $sweetheart_b): string
  {
    return <<<EXPECTED_HEART
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
  }
}
