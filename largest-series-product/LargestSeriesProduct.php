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

class Series
{
    public function __construct(private string $input)
    {
    }

    public function largestProduct(int $span): int
    {
        $products = [];
        $inputLength = strlen($this->input);
        if ($span > $inputLength || $span < 0 || (!is_numeric($this->input) && $span !== 0)) {
            throw new InvalidArgumentException();
        }
        
        for ($i = 0; $i < $inputLength - $span; $i++) {
            $products[] = $this->getProduct($i, $span);
        }

        $lastProduct = $this->getProduct($i, $span);
        $products[] = $lastProduct;

        return max($products);
    }
    
    private function getProduct(int $startIndex, int $span): int
    {
        return array_product(str_split(substr($this->input, $startIndex, $span))); 
    }
}
