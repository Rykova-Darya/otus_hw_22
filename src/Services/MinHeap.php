<?php

namespace App\Services;

class MinHeap
{
    private array $heap = [];
    private array $positions = [];

    public function insert(int $vertex, int $dist): void
    {
        $this->heap[] = [$dist, $vertex];
        $this->positions[$vertex] = count($this->heap) - 1;
        $this->heapifyUp(count($this->heap) - 1);
    }

    public function extractMin(): ?array
    {
        if (empty($this->heap)) return null;

        $min = $this->heap[0];
        $last = array_pop($this->heap);

        if (!empty($this->heap)) {
            $this->heap[0] = $last;
            $this->heapifyDown(0);
        }

        unset($this->positions[$min[1]]);
        return $min;

    }

    private function heapifyUp(int $index): void
    {
        while ($index > 0) {
            $parent = (int)(($index - 1) / 2);
            if ($this->heap[$index][0] >= $this->heap[$parent][0]) break;

            $this->swap($index, $parent);
            $index = $parent;
        }

    }
    private function heapifyDown(int $index): void
    {
        $size = count($this->heap);
        while (true) {
            $left = 2 * $index + 1;
            $right = 2 * $index + 2;
            $smallest = $index;

            if ($left < $size && $this->heap[$left][0] < $this->heap[$smallest][0]) {
                $smallest = $left;
            }
            if ($right < $size && $this->heap[$right][0] < $this->heap[$smallest][0]) {
                $smallest = $right;
            }

            if ($smallest === $index) break;

            $this->swap($index, $smallest);
            $index = $smallest;
        }
    }

    private function swap(int $i, int $j): void
    {
        [$this->heap[$i], $this->heap[$j]] = [$this->heap[$j], $this->heap[$i]];
        $this->positions[$this->heap[$i][1]] = $i;
        $this->positions[$this->heap[$j][1]] = $j;
    }

    public function isEmpty(): bool
    {
        return empty($this->heap);
    }


}