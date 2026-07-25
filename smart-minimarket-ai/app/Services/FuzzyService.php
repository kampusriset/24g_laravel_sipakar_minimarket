<?php

namespace App\Services;

class FuzzyService
{
    public function calculate($stock, $minimumStock, $penjualan)
    {
        // ===========================
        // MEMBERSHIP STOCK
        // ===========================

        $stockSedikit = 0;
        $stockSedang = 0;
        $stockBanyak = 0;

        if ($stock <= $minimumStock) {

            $stockSedikit = 1;

        } elseif ($stock <= ($minimumStock * 2)) {

            $stockSedikit =
                (($minimumStock * 2) - $stock)
                / $minimumStock;

            $stockSedang =
                ($stock - $minimumStock)
                / $minimumStock;

        } else {

            $stockBanyak = 1;

        }

        // ===========================
        // MEMBERSHIP PENJUALAN
        // ===========================

        $jualRendah = 0;
        $jualSedang = 0;
        $jualTinggi = 0;

        if ($penjualan <= 10) {

            $jualRendah = 1;

        } elseif ($penjualan <= 30) {

            $jualSedang =
                ($penjualan - 10)
                / 20;

            $jualRendah =
                (30 - $penjualan)
                / 20;

        } else {

            $jualTinggi = 1;

        }

        // ===========================
        // SCORE
        // ===========================

        $score =
            (($stockSedikit * 60) +
            ($stockSedang * 35) +
            ($stockBanyak * 5))
            +
            (($jualTinggi * 40) +
            ($jualSedang * 20));

        if ($score >= 80) {

            $status = "Segera Restock";

        } elseif ($score >= 50) {

            $status = "Perlu Dipantau";

        } else {

            $status = "Stock Aman";

        }

        return [

            "score" => round($score,2),

            "status" => $status,

            "membership" => [

                "stock" => [

                    "sedikit" => round($stockSedikit,2),

                    "sedang" => round($stockSedang,2),

                    "banyak" => round($stockBanyak,2)

                ],

                "penjualan" => [

                    "rendah" => round($jualRendah,2),

                    "sedang" => round($jualSedang,2),

                    "tinggi" => round($jualTinggi,2)

                ]

            ]

        ];
    }
}