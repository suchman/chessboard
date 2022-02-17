<?php declare(strict_types=1);

namespace Chessboard\Piece;

use Chessboard\Field\ChessboardField;

final class Knight extends AbstractChessboardPiece
{
    private static array $possibleMoves = [[1,-2],[2,-1],[2,1],[1,2],[-1,2],[-2,1],[-2,-1],[-1,-2]];

    /**
     * @param ChessboardField $targetField
     * @return void
     */
    public function move(ChessboardField $targetField): void
    {
        $possibleMoves = self::getPossibleMoves();
        [$xDiff, $yDiff] = $this->chessboardField->computeDiff($targetField);

        if (in_array([$xDiff, $yDiff], $possibleMoves)) {
            $this->setChessboardField($targetField);
            $this->movesHistory[$targetField->getCoords()->getId()] = $targetField;
            return;
        }

        throw new ForbiddenChessboardPieceMoveException();
    }

    /**
     * @return array
     */
    public static function getPossibleMoves(): array
    {
        return self::$possibleMoves;
    }
}