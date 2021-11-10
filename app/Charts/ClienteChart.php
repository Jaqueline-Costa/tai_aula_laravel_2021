<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ClienteChart
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart;
    }

    public function build()
    {
        return $this->chart->areaChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);;
    }
}
