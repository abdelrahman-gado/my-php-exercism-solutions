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
        $placesCount = $this->countPlaces($board);
        if (!$this->checkValidBoard($board, $placesCount)) {
            throw new RuntimeException('Invalid board');
        }

        $winner = $this->findWinner($board);
        if ($winner) {
            return State::Win;
        }

        return $placesCount[' '] === 0 ? State::Draw : State::Ongoing;
    }

    private function findWinner(array $board): string|bool
    {
        return match (true) {
            // check rows
            $board[0][0] === $board[0][1] && $board[0][1] === $board[0][2] && $board[0][0] === $board[0][2] && $board[0][0] !== ' ' => $board[0][0],
            $board[1][0] === $board[1][1] && $board[1][1] === $board[1][2] && $board[1][0] === $board[1][2] && $board[1][0] !== ' ' => $board[1][0],
            $board[2][0] === $board[2][1] && $board[2][1] === $board[2][2] && $board[2][0] === $board[2][2] && $board[2][0] !== ' ' => $board[2][0],

            // check columns
            $board[0][0] === $board[1][0] && $board[1][0] === $board[2][0] && $board[0][0] === $board[2][0] && $board[0][0] !== ' ' => $board[0][0],
            $board[0][1] === $board[1][1] && $board[1][1] === $board[2][1] && $board[0][1] === $board[2][1] && $board[0][1] !== ' ' => $board[0][1],
            $board[0][2] === $board[1][2] && $board[1][2] === $board[2][2] && $board[2][2] === $board[0][2] && $board[0][2] !== ' ' => $board[0][2],

            // check diagonals
            $board[0][0] === $board[1][1] && $board[1][1] === $board[2][2] && $board[2][2] === $board[0][0] && $board[0][0] !== ' ' => $board[0][0],
            $board[0][2] === $board[1][1] && $board[1][1] === $board[2][0] && $board[2][0] === $board[0][2] && $board[0][2] !== ' ' => $board[0][2],

            default => false,
        };
    }

    private function countPlaces(array $board): array
    {
        $placesCount = ['X' => 0, 'O' => 0, ' ' => 0];
        foreach ($board as $row) {
            foreach (str_split($row) as $place) {
                $placesCount[$place]++;
            }
        }

        return $placesCount;
    }

    private function checkValidBoard(array $board, array $placeCount): bool
    {
        if ($placeCount['O'] > $placeCount['X']) {
            throw new RuntimeException('Wrong turn order: O started');
        }

        if ($placeCount['X'] > $placeCount['O'] + 1) {
            throw new RuntimeException('Wrong turn order: X went twice');
        }

        $winner = $this->findWinner($board);
        if (
            ($winner === 'X' && ($placeCount['X'] <= $placeCount['O'] || ($placeCount[' '] === 0 && !$this->rowColumnVictory($board) && !$this->diagonalVictory($board))))
            ||
            ($winner === 'O' && $placeCount['X'] > $placeCount['O'])
        ) {
            throw new RuntimeException('Impossible board: game should have ended after the game was won');
        }

        return true;
    }

    private function rowColumnVictory(array $board): bool
    {
        return (
            $board[0][0] === $board[0][1] && $board[0][1] === $board[0][2] && $board[0][0] === $board[0][2] && $board[0][0] !== ' '
            &&
            $board[0][0] === $board[1][0] && $board[1][0] === $board[2][0] && $board[0][0] === $board[2][0] && $board[0][0] !== ' '
        ) || (
            $board[0][0] === $board[0][1] && $board[0][1] === $board[0][2] && $board[0][0] === $board[0][2] && $board[0][0] !== ' '
            &&
            $board[0][2] === $board[1][2] && $board[1][2] === $board[2][2] && $board[2][2] === $board[0][2] && $board[0][2] !== ' '
        ) || (
            $board[2][0] === $board[2][1] && $board[2][1] === $board[2][2] && $board[2][0] === $board[2][2] && $board[2][0] !== ' '
            &&
            $board[0][0] === $board[1][0] && $board[1][0] === $board[2][0] && $board[0][0] === $board[2][0] && $board[0][0] !== ' '
        ) || (
            $board[2][0] === $board[2][1] && $board[2][1] === $board[2][2] && $board[2][0] === $board[2][2] && $board[2][0] !== ' '
            &&
            $board[0][2] === $board[1][2] && $board[1][2] === $board[2][2] && $board[2][2] === $board[0][2] && $board[0][2] !== ' '
        );
    }

    private function diagonalVictory(array $board): bool
    {
        return (
            $board[0][0] === $board[1][1] && $board[1][1] === $board[2][2] && $board[2][2] === $board[0][0] && $board[0][0] !== ' '
            ||
            $board[0][2] === $board[1][1] && $board[1][1] === $board[2][0] && $board[2][0] === $board[0][2] && $board[0][2] !== ' '
        );
    }
}