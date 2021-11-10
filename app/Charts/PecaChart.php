<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class PecaChart
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }

    public function build()
    {
        return $this->chart->horizontalBarChart()
            ->setTitle('Estoque de peças.')
            ->setSubtitle('Quantidade de ferramentas e materias de construção em 2021.')
            ->setColors(['#E08F00', '#3C1642', '#AFFC41', '#000D42', '#B7CE63', '#EEB868', '#7B9E87', '#7FB069', '#2F2235'])
            ->addData('Martelo', [3])
            ->addData('Trena', [2])
            ->addData('Areia', [20])
            ->addData('Telha', [100])
            ->addData('Tijolo', [300])
            ->addData('Cimento', [100])
            ->addData('Carrinho de mão', [5])
            ->addData('Tinta branca', [7])
            ->addData('Rolo de tinta', [6])
            ->setXAxis(['2021']);
    }
}
