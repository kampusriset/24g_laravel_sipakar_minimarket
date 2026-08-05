<?php

namespace App\Services;

class FuzzyService
{
    public function calculate($stock, $minimumStock, $penjualan)
    {
        /*
        ============================================
        FUZZIFIKASI STOCK
        ============================================
        */

        $stockSedikit = 0;
        $stockSedang  = 0;
        $stockBanyak  = 0;

        if ($stock <= $minimumStock) {

            $stockSedikit = 1;

        } elseif ($stock <= ($minimumStock * 2)) {

            $stockSedikit =
                (($minimumStock * 2) - $stock) / $minimumStock;

            $stockSedang =
                ($stock - $minimumStock) / $minimumStock;

        } else {

            $stockBanyak = 1;

        }

        /*
        ============================================
        FUZZIFIKASI PENJUALAN
        ============================================
        */

        $jualRendah = 0;
        $jualSedang = 0;
        $jualTinggi = 0;

        if ($penjualan <= 10) {

            $jualRendah = 1;

        } elseif ($penjualan <= 30) {

            $jualRendah =
                (30 - $penjualan) / 20;

            $jualSedang =
                ($penjualan - 10) / 20;

        } else {

            $jualTinggi = 1;

        }

        /*
        ============================================
        INFERENSI (RULE)
        ============================================
        */

        $r1 = min($stockSedikit, $jualTinggi); // Restock
        $r2 = min($stockSedikit, $jualSedang); // Restock
        $r3 = min($stockSedang, $jualTinggi);  // Pantau
        $r4 = min($stockSedang, $jualSedang);  // Pantau
        $r5 = min($stockBanyak, $jualRendah);  // Aman

        /*
        ============================================
        DEFUZZIFIKASI
        ============================================
        */

        $atas =
            ($r1 * 100) +
            ($r2 * 90) +
            ($r3 * 60) +
            ($r4 * 50) +
            ($r5 * 20);

        $bawah =
            $r1 +
            $r2 +
            $r3 +
            $r4 +
            $r5;

        $score = $bawah == 0 ? 0 : $atas / $bawah;

        /*
        ============================================
        STATUS
        ============================================
        */

        if ($score >= 80) {

            $status = "Segera Restock";

        } elseif ($score >= 50) {

            $status = "Perlu Dipantau";

        } else {

            $status = "Stock Aman";

        }

        /*
        ============================================
        RETURN
        ============================================
        */

        return [

            "score" => round($score, 2),

            "status" => $status,

            "membership" => [

                "stock" => [

                    "sedikit" => round($stockSedikit, 2),
                    "sedang"  => round($stockSedang, 2),
                    "banyak"  => round($stockBanyak, 2)

                ],

                "penjualan" => [

                    "rendah" => round($jualRendah, 2),
                    "sedang" => round($jualSedang, 2),
                    "tinggi" => round($jualTinggi, 2)

                ]

            ],

            "rule" => [

                "R1" => round($r1,2),
                "R2" => round($r2,2),
                "R3" => round($r3,2),
                "R4" => round($r4,2),
                "R5" => round($r5,2),

            ]

        ];
    }
}