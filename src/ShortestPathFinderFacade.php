<?php declare(strict_types=1);

namespace Chessboard;

use Chessboard\Field\ChessboardCoords;
use Chessboard\Field\OutOfChessboardException;
use Chessboard\Piece\Knight;

final class ShortestPathFinderFacade
{
    private Chessboard $chessboard;

    public function __construct(Chessboard $chessboard)
    {
        $this->chessboard = $chessboard;
    }

    /**
     * method finds shortest path which knight piece move from a to b
     *
     * @throws OutOfChessboardException
     */
    public function findShortestKnightPath(ChessboardCoords $targetCoords, ChessboardCoords $startCoords): array
    {
        $collector = new KnightFieldStepsCollector($this->chessboard);

        $targetField = $this->chessboard->getChessboardField($targetCoords);
        $startField = $this->chessboard->getChessboardField($startCoords);

        $collector->collect($targetField);

        $knight = new Knight($startField);

        $guide = new KnightShortestPathGuide($this->chessboard);

        $guide->findShortestPath($knight);

        return $knight->getMovesHistory();
    }
}