<?php declare(strict_types=1);

namespace Chessboard\Field;

final class ChessboardField
{
    private ChessboardCoords $coords;
    private int $knightMovesStep = 999;

    public function __construct(ChessboardCoords $coords)
    {
        $this->coords = $coords;
    }

    public function getCoords(): ChessboardCoords
    {
        return $this->coords;
    }

    /**
     * @return int[]
     */
    public function getSimpleCoords(): array
    {
        return $this->getCoords()->getSimpleCoords();
    }

    /**
     * @return int
     */
    public function getKnightMovesStep(): int
    {
        return $this->knightMovesStep;
    }

    /**
     * @param int
     */
    public function setKnightMovesStep(int $knightMovesStep): void
    {
        $this->knightMovesStep = $knightMovesStep;
    }

    /**
     * @param ChessboardField $chessboardField
     * @return int[]
     */
    public function computeDiff(ChessboardField $chessboardField): array
    {
        /** @var ChessboardCoords $actualCoords */
        [$x, $y] = $this->getSimpleCoords();

        /** @var ChessboardCoords $targetCoords */
        [$targetX, $targetY] = $chessboardField->getSimpleCoords();

        return [$x - $targetX, $y - $targetY];
    }
}