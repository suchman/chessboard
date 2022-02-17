<?php declare(strict_types=1);

namespace Chessboard\Piece;

use Chessboard\Field\ChessboardField;

abstract class AbstractChessboardPiece
{
    protected ChessboardField $chessboardField;
    protected array $movesHistory = [];

    public function __construct(ChessboardField $chessboardField)
    {
        $this->chessboardField = $chessboardField;
    }

    /**
     * return array of possible piece moves
     *
     * @return array
     */
    abstract public static function getPossibleMoves(): array;

    /**
     * set new chessboard field for piece, and return it
     *
     * @param ChessboardField $targetField
     * @return void
     */
    abstract public function move(ChessboardField $targetField): void;

    /**
     * returns actual field where piece stands
     *
     * @return ChessboardField
     */
    public function getChessboardField(): ChessboardField
    {
        return $this->chessboardField;
    }

    public function getMovesHistory(): array
    {
        return $this->movesHistory;
    }

    public function resetMovesHistory(): array
    {
        return $this->movesHistory = [];
    }

    protected function setChessboardField(ChessboardField $chessboardField): void
    {
        $this->chessboardField = $chessboardField;
    }
}