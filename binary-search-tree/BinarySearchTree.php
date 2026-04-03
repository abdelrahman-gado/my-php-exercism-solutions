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

class BinarySearchTree
{
    public ?BinarySearchTree $left;
    public ?BinarySearchTree $right;
    public int $data;

    public function __construct(int $data)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }

    public function insert(int $data): void
    {
        $current = $this;
        while (true) {
            if ($data <= $current->data) {
                if ($current->left !== null) {
                    $current = $current->left;
                } else {
                    $current->left = new BinarySearchTree($data);
                    return;
                }
            } else {
                if ($current->right !== null) {
                    $current = $current->right;
                } else {
                    $current->right = new BinarySearchTree($data);
                    return;
                }
            }
        }
    }

    public function getSortedData(): array
    {
        $result = [];
        $this->inOrderTraversal($this, $result);
        return $result;
    }

    private function inOrderTraversal(?BinarySearchTree $node, array &$result): void
    {
        if ($node === null) {
            return;
        }

        $this->inOrderTraversal($node->left, $result);
        $result[] = $node->data;
        $this->inOrderTraversal($node->right, $result);
    }
}
