<?php declare(strict_types=1);

namespace Chessboard\Collection;

use Chessboard\Field\ChessboardField;

final class KnightFieldStepsCollection implements \Countable
{
    private array $fieldsGroupedByStep = [];
    private array $fields = [];

    public function addField(ChessboardField $chessboardField): void
    {
        $this->fieldsGroupedByStep[$chessboardField->getKnightMovesStep()][] = $chessboardField;
        $this->fields[$chessboardField->getCoords()->getId()] = $chessboardField;
    }

    public function getFieldsWithStep(int $step): array
    {
        if (isset($this->fieldsGroupedByStep[$step])) {
            return $this->fieldsGroupedByStep[$step];
        }

        return [];
    }

    public function count(): int
    {
        return count($this->fields);
    }

    public function fieldExists(ChessboardField $chessboardField): bool
    {
        return array_key_exists($chessboardField->getCoords()->getId(), $this->fields);
    }
}