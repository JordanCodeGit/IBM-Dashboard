<?php

namespace App\Charts;

use marineusde\LarapexCharts\Charts\BarChart AS OriginalBarChart;

class SalesDailyChart
{
    public static function build(): OriginalBarChart
    {
        return (new OriginalBarChart)->setTitle('Sales Daily Chart '.date('d - m - Y'));
    }
}
