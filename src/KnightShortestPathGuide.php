<?php declare(strict_types=1);

namespace Chessboard;

use Chessboard\Field\ChessboardField;
use Chessboard\Field\OutOfChessboardException;
use Chessboard\Piece\Knight;

/**
 * Class gets knight piece, then look on field which
 * could move and find the one with lowest steos to target
 */
final class KnightShortestPathGuide
{
    private Chessboard $chessboard;

    public function __construct(Chessboard $chessboard)
    {
        $this->chessboard = $chessboard;
    }

    /**
     * @param Knight $knight
     * @return void
     * @throws OutOfChessboardException
     */
    public function findShortestPath(Knight $knight): void
    {
        $knight->resetMovesHistory();

        $targetFound = false;

        while ($targetFound === false) {
            $newField = $this->findShortestStep($knight);

            $knight->move($newField);

            if ($knight->getChessboardField()->getKnightMovesStep() === 0) {
                $targetFound = true;
            }
        }
    }

    /**
     * @param Knight $knight
     * @return ChessboardField
     */
    private function findShortestStep(Knight $knight): ChessboardField
    {
        $possibleNewFields = $this->findPossibleFields($knight);

        usort($possibleNewFields, function (ChessboardField $a, ChessboardField $b) {
            return $a->getKnightMovesStep() > $b->getKnightMovesStep();
        });

        /** @var ChessboardField $shortestPathNewField */
        return array_shift($possibleNewFields);
    }

    /**
     * @param Knight $knight
     * @return array
     */
    private function findPossibleFields(Knight $knight): array
    {
        $actualCoords = $knight->getChessboardField()->getCoords();
        $possibleNewFields = [];

        foreach (Knight::getPossibleMoves() as [$x, $y]) {
            try {
                $newCoords = $actualCoords->computeNewCoords($x, $y);
            } catch (OutOfChessboardException $exception) {
                continue;
            }

            $possibleNewFields[] = $this->chessboard->getChessboardField($newCoords);
        }

        return $possibleNewFields;
    }
}