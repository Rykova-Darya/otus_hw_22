<?php

namespace App\Command;

use App\Services\Dijkstra;
use App\Services\Edge;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'dijkstra',
    description: 'Алгоритм Дейкстры',
)]
class DijkstraCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

//    protected function configure(): void
//    {
//        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
//    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $A = [
          [1, 2],
          [0, 2, 3],
          [0, 1, 5, 3],
          [1, 2, 4, 5],
          [3, 5],
          [2, 3, 4, 6],
          [5, 0]
        ];

        $weights = [
            [7, 14],
            [7, 9, 10],
            [14, 9, 2, 9],
            [10, 9, 11, 10],
            [11, 6],
            [2, 10, 6, 9],
            [9, 14]
        ];

        $N = count($A);
        $start = 0;
        $dijkstra = new Dijkstra();
        $result = $dijkstra->dijkstra($A, $weights, $N, $start);

        /** @var Edge $edge */
        foreach ($result as $edge) {
            echo "{$edge->v1} — $edge->v2}\n";
        }

        return Command::SUCCESS;
    }
}
