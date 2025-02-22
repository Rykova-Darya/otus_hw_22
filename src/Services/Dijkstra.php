<?php

namespace App\Services;

class Dijkstra
{
    public function dijkstra(array $A, array $weights, int $N, int $start): array
    {
        $dist = array_fill(0, $N, PHP_INT_MAX);
        $prev = array_fill(0, $N, -1);
        $dist[$start] = 0;

        $pq = new MinHeap();
        $pq->insert($start, 0);

        while (!$pq->isEmpty()) {
            [$d, $u] = $pq->extractMin();

            foreach ($A[$u] as $i => $v) {
                $weight = $weights[$u][$i];
                if ($dist[$v] > $d + $weight) {
                    $dist[$v] = $d + $weight;
                    $prev[$v] = $u;
                    $pq->insert($v, $dist[$v]);
                }
            }
        }

        $edges = [];
        for ($i = 0; $i < $N; $i++) {
            if ($prev[$i] !== -1) {
                $edges[] = new Edge($prev[$i], $i);
            }
        }

        return $edges;
    }
}