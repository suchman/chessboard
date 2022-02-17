<?php declare(strict_types=1);

namespace Chessboard\Field;

final class ChessboardCoords
{
    private int $xCoords;

    private int $yCoords;

    /**
     * @throws OutOfChessboardException
     */
    public function __construct(int $xCoords, int $yCoords)
    {
        if ($xCoords > 8 || $xCoords < 1 || $yCoords < 1 || $yCoords > 8) {
            throw new OutOfChessboardException();
        }

        $this->xCoords = $xCoords;
        $this->yCoords = $yCoords;
    }

    public function getId(): string
    {
        return $this->getXCoords() . $this->getYCoords();
    }

    public function getXCoords(): int
    {
        return $this->xCoords;
    }

    public function getYCoords(): int
    {
        return $this->yCoords;
    }

    /**
     * @throws OutOfChessboardException
     */
    public function computeNewCoords(int $x, int $y): ChessboardCoords
    {
        return new ChessboardCoords($this->getXCoords() + $x, $this->getYCoords() + $y);
    }

    /**
     * @return int[]
     */
    public function getSimpleCoords(): array
    {
        return [$this->getXCoords(), $this->getYCoords()];
    }
}