<?php

namespace App\Helpers;


class IslandHelper {
    protected $ROW = 5;
    protected $COL = 5;

    public function __construct($rowLength=5, $colLength=5)
    {
        $this->ROW = $rowLength;
        $this->COL = $colLength;
    }

    public function makeMap(): Array
    {
        $map = [];

        for ($i = 0; $i < $this->ROW; $i++) {
            for ($k = 0; $k < $this->COL; $k++) {
                $map[$i][$k] = rand(0.0, 1.0) > 0.5 ? 1 : 0;
            }
        }

        return $map;
    }

    public function isSafe(&$map, $row, $col, &$visited) {
        return ($row >= 0) && ($row < $this->ROW) &&
            ($col >= 0) && ($col < $this->COL) &&
            ($map[$row][$col] && !isset($visited[$row][$col]));
    }

    public function DFS(&$map, $row, $col, &$visited) {
        $rowNbr = [-1, 0, 0, 1];
        $colNbr = [0, -1, 1, 0];
        $visited[$row][$col] = true;
        for ($k = 0; $k < 4; ++$k) {
            if ($this->isSafe($map, $row + $rowNbr[$k], $col + $colNbr[$k], $visited)) {
                $this->DFS($map, $row + $rowNbr[$k], $col + $colNbr[$k], $visited);
            }
        }
    }

    public function countIslands(&$map) {
        $visited = [[]];

        $count = 0;
        for ($i = 0; $i < $this->ROW; $i++) {
            for ($j = 0; $j < $this->COL; $j++) {
                if ($map[$i][$j] && !isset($visited[$i][$j])) {
                    $this->DFS($map, $i, $j, $visited);
                    $count++;
                }
            }
        }

        return $count;
    }
}
