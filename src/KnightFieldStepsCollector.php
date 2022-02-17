<?php declare(strict_types=1);

namespace Chessboard;

use Chessboard\Collection\KnightFieldStepsCollection;
use Chessboard\Field\ChessboardField;
use Chessboard\Field\OutOfChessboardException;
use Chessboard\Piece\Knight;

/**
 * Class compute number of steps to target field for every field on chessboard
 */
final class KnightFieldStepsCollector
{
    private Chessboard $chessboard;

    private KnightFieldStepsCollection $stepsCollection;

    private int $step = 0;

    public function __construct(Chessboard $chessboard)
    {
        $this->chessboard = $chessboard;
    }

    /**
     * simply start process of computing steps to target field
     *
     * @param ChessboardField $targetField
     * @return KnightFieldStepsCollection
     */
    public function collect(ChessboardField $targetField): KnightFieldStepsCollection
    {
        $targetField->setKnightMovesStep(0);

        $this->stepsCollection =  new KnightFieldStepsCollection();
        $this->stepsCollection->addField($targetField);

        // 64 - target field
        while (count($this->stepsCollection) <= 63) {
            $this->processStep();
        }

        return $this->stepsCollection;
    }

    private function processStep(): void
    {
        /** @var ChessboardField $fieldWithCurrentStep */
        foreach ($this->stepsCollection->getFieldsWithStep($this->step) as $fromField) {
            $this->processPossibleKnightMoves($fromField);
        }

        $this->step++;
    }

    /**
     * @param ChessboardField $fromField
     * @return void
     */
    private function processPossibleKnightMoves(ChessboardField $fromField): void
    {
        foreach (Knight::getPossibleMoves() as [$x, $y]) {
            try {
                $newField = $this->chessboard->findTargetFieldToMove($fromField, $x, $y);
            } catch (OutOfChessboardException $e) {
                continue;
            }

            if (!$this->stepsCollection->fieldExists($newField)) {
                $newField->setKnightMovesStep($this->step + 1);

                $this->stepsCollection->addField($newField);
            }
        }
    }
}