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

enum State
{
    case Win;
    case Ongoing;
    case Draw;
}

class StateOfTicTacToe
{
    public function gameState(array $board): State
    {
        $xCount = $this->countPlayer($board, 'X');
        $oCount = $this->countPlayer($board, 'O');

        if ($xCount < $oCount) {
            throw new \RuntimeException("Wrong turn order: O started");
        }

        if ($xCount !== $oCount && $xCount !== $oCount + 1) {
            throw new \RuntimeException("Wrong turn order: X went twice");
        }

        $xWon = $this->hasWon($board, 'X');
        $oWon = $this->hasWon($board, 'O');

        if ($xWon && $oWon) {
            throw new \RuntimeException("Impossible board: game should have ended after the game was won");
        }

        if ($xWon || $oWon) {
            return State::Win;
        }

        if ($xCount + $oCount === 9) {
            return State::Draw;
        }

        return State::Ongoing;
    }

    private function countPlayer(array $board, string $player): int
    {
        $count = 0;
        foreach ($board as $row) {
            foreach (str_split($row) as $cell) {
                if ($cell === $player) {
                    $count++;
                }
            }
        }

        return $count;
    }

    private function hasWon(array $board, string $player): bool
    {
        for ($i = 0; $i < 3; $i++) {
            if (
                $board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player
                ||
                $board[0][$i] === $player && $board[1][$i] === $player && $board[2][$i] === $player
            ) {
                return true;
            }
        }

        return $board[0][0] === $player && $board[1][1] === $player && $board[2][2] === $player
            ||
            $board[0][2] === $player && $board[1][1] === $player && $board[2][0] === $player;
    }
}