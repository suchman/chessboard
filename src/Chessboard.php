<?php declare(strict_types=1);

namespace Chessboard;

use Chessboard\Field\ChessboardCoords;
use Chessboard\Field\ChessboardField;
use Chessboard\Field\OutOfChessboardException;

/**
 * Object of chessboard - "collection" of chessboard fields
 */
final class Chessboard
{
    private array $fields = [];

    /**
     * @throws Field\OutOfChessboardException
     */
    public function __construct()
    {
        $this->initializeChessboardFields();
    }

    public function getChessboardField(ChessboardCoords $coords): ChessboardField
    {
        return $this->fields[$coords->getId()];
    }

    /**
     * @param ChessboardField $fromField
     * @param int $xDiff
     * @param int $yDiff
     * @return ChessboardField
     * @throws OutOfChessboardException
     */
    public function findTargetFieldToMove(ChessboardField $fromField, int $xDiff, int $yDiff): ChessboardField
    {
        $newCoords = $fromField->getCoords()->computeNewCoords($xDiff, $yDiff);

        return $this->getChessboardField($newCoords);
    }

    /**
     * @throws Field\OutOfChessboardException
     */
    private function initializeChessboardFields(): void
    {
        for ($x = 1; $x <= 8; $x++) {
            for ($y = 1; $y <= 8; $y++) {
                $coords = new ChessboardCoords($x, $y);
                $this->fields[$coords->getId()] = new ChessboardField($coords);
            }
        }
    }
}