<?php

use Chessboard\Chessboard;
use Chessboard\Field\ChessboardCoords;
use Chessboard\Field\OutOfChessboardException;
use Chessboard\ShortestPathFinderFacade;

include_once 'vendor/autoload.php';

printf('Enter start X coordinates: ');
$startX = (int) fgets(STDIN);

printf('Enter start Y coordinates: ');
$startY = (int) fgets(STDIN);

printf('Enter target X coordinates: ');
$targetX = (int) fgets(STDIN);

printf('Enter target Y coordinates: ');
$targetY = (int) fgets(STDIN);

$chessboard = new Chessboard();

$finderFacade = new ShortestPathFinderFacade($chessboard);

try {
    $targetCoords = new ChessboardCoords($startX, $startY);
    $startCoords = new ChessboardCoords($targetX, $targetY);
} catch (OutOfChessboardException $e) {
    echo 'Start or target coordinates is out of chessboard!';
    exit;
}

$path = $finderFacade->findShortestKnightPath($targetCoords, $startCoords);

echo '     1   2   3   4   5   6   7   8  '. "\n";

for ($j = 1; $j <= 8; $j++) {
    echo ' ' . $j .' ';
    for ($i = 1; $i <= 8; $i++) {
        if ($i === $startX && $j === $startY) {
            echo '| S ';
        } elseif ($i === $targetX && $j === $targetY) {
            echo '| C ';
        } elseif (isset($path[$i . $j])) {
            echo '| x ';
        } else {
            echo '|   ';
        }
    }

    echo '|' . "\n";
}
