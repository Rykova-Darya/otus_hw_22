<?php

namespace App\Services;

class Edge
{
    public int $v1;
    public int $v2;

    public function __construct(int $v1, int $v2)
    {
        $this->v1 = $v1;
        $this->v2 = $v2;
    }

}