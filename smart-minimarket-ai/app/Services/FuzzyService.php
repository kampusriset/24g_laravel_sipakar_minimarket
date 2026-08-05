<?php

namespace App\Services;

class FuzzyService
{
    public function calculate(
        $stock,
        $minimumStock,
        $rataPenjualan,
        $leadTime
    ) {

        // 1. Fuzzifikasi
        $stockMembership = $this->fuzzifyStock(
            $stock,
            $minimumStock
        );

        $salesMembership = $this->fuzzifySales(
            $rataPenjualan
        );

        $leadMembership = $this->fuzzifyLeadTime(
            $leadTime
        );

        // 2. Inferensi
        $rules = $this->inference(
            $stockMembership,
            $salesMembership,
            $leadMembership
        );

        // 3. Defuzzifikasi
        $score = $this->defuzzification($rules);

        // 4. Status
        $status = $this->determineStatus($score);

        return [

            'score' => round($score, 2),

            'status' => $status,

            'membership' => [

                'stock' => $stockMembership,

                'penjualan' => $salesMembership,

                'leadTime' => $leadMembership

            ],

            'rule' => $rules

        ];
    }

    /*
    ===================================================
    Membership Stock
    ===================================================
    */

    private function fuzzifyStock($stock, $minimum)
    {
        $sedikit = 0;
        $sedang = 0;
        $banyak = 0;

        $batas1 = $minimum;
        $batas2 = $minimum * 2;
        $batas3 = $minimum * 3;

        // Sedikit
        if ($stock <= $batas1) {

            $sedikit = 1;
        } elseif ($stock > $batas1 && $stock < $batas2) {

            $sedikit = ($batas2 - $stock) / ($batas2 - $batas1);
        }

        // Sedang
        if ($stock >= $batas1 && $stock <= $batas2) {

            $sedang = ($stock - $batas1) / ($batas2 - $batas1);
        } elseif ($stock > $batas2 && $stock <= $batas3) {

            $sedang = ($batas3 - $stock) / ($batas3 - $batas2);
        }

        // Banyak
        if ($stock >= $batas3) {

            $banyak = 1;
        } elseif ($stock > $batas2 && $stock < $batas3) {

            $banyak = ($stock - $batas2) / ($batas3 - $batas2);
        }

        return [

            'sedikit' => round(max(0, $sedikit), 2),
            'sedang' => round(max(0, $sedang), 2),
            'banyak' => round(max(0, $banyak), 2)

        ];
    }

    /*
    ===================================================
    Membership Penjualan
    ===================================================
    */

    private function fuzzifySales($penjualan)
    {
        $rendah = 0;
        $sedang = 0;
        $tinggi = 0;

        // Rendah
        if ($penjualan <= 10) {

            $rendah = 1;
        } elseif ($penjualan < 25) {

            $rendah = (25 - $penjualan) / 15;
        }

        // Sedang
        if ($penjualan >= 10 && $penjualan <= 25) {

            $sedang = ($penjualan - 10) / 15;
        } elseif ($penjualan > 25 && $penjualan <= 40) {

            $sedang = (40 - $penjualan) / 15;
        }

        // Tinggi
        if ($penjualan >= 40) {

            $tinggi = 1;
        } elseif ($penjualan > 25 && $penjualan < 40) {

            $tinggi = ($penjualan - 25) / 15;
        }

        return [

            'rendah' => round(max(0, $rendah), 2),
            'sedang' => round(max(0, $sedang), 2),
            'tinggi' => round(max(0, $tinggi), 2)

        ];
    }

    /*
    ===================================================
    Membership Lead Time
    ===================================================
    */

    private function fuzzifyLeadTime($leadTime)
    {
        $cepat = 0;
        $sedang = 0;
        $lama = 0;

        // Cepat
        if ($leadTime <= 2) {
            $cepat = 1;
        } elseif ($leadTime < 5) {
            $cepat = (5 - $leadTime) / 3;
        }

        // Sedang
        if ($leadTime >= 2 && $leadTime <= 5) {

            $sedang = ($leadTime - 2) / 3;
        } elseif ($leadTime > 5 && $leadTime <= 8) {

            $sedang = (8 - $leadTime) / 3;
        }

        // Lama
        if ($leadTime >= 8) {

            $lama = 1;
        } elseif ($leadTime > 5 && $leadTime < 8) {

            $lama = ($leadTime - 5) / 3;
        }

        return [

            'cepat' => round(max(0, $cepat), 2),
            'sedang' => round(max(0, $sedang), 2),
            'lama' => round(max(0, $lama), 2)

        ];
    }

    /*
    ===================================================
    Inferensi
    ===================================================
    */

    private function inference($stock, $sales, $lead)
    {
        /*
    ============================================
    OUTPUT CRISP
    ============================================
    */

        $output = [

            'Aman' => 20,
            'Pantau' => 60,
            'Restock' => 100

        ];

        /*
    ============================================
    RULE BASE
    ============================================
    */

        $ruleBase = [

            // STOCK SEDIKIT
            ['sedikit', 'tinggi', 'lama', 'Restock'],
            ['sedikit', 'tinggi', 'sedang', 'Restock'],
            ['sedikit', 'tinggi', 'cepat', 'Restock'],

            ['sedikit', 'sedang', 'lama', 'Restock'],
            ['sedikit', 'sedang', 'sedang', 'Restock'],
            ['sedikit', 'sedang', 'cepat', 'Pantau'],

            ['sedikit', 'rendah', 'lama', 'Pantau'],
            ['sedikit', 'rendah', 'sedang', 'Pantau'],
            ['sedikit', 'rendah', 'cepat', 'Pantau'],

            // STOCK SEDANG
            ['sedang', 'tinggi', 'lama', 'Restock'],
            ['sedang', 'tinggi', 'sedang', 'Pantau'],
            ['sedang', 'tinggi', 'cepat', 'Pantau'],

            ['sedang', 'sedang', 'lama', 'Pantau'],
            ['sedang', 'sedang', 'sedang', 'Pantau'],
            ['sedang', 'sedang', 'cepat', 'Aman'],

            ['sedang', 'rendah', 'lama', 'Pantau'],
            ['sedang', 'rendah', 'sedang', 'Aman'],
            ['sedang', 'rendah', 'cepat', 'Aman'],

            // STOCK BANYAK
            ['banyak', 'tinggi', 'lama', 'Pantau'],
            ['banyak', 'tinggi', 'sedang', 'Pantau'],
            ['banyak', 'tinggi', 'cepat', 'Aman'],

            ['banyak', 'sedang', 'lama', 'Aman'],
            ['banyak', 'sedang', 'sedang', 'Aman'],
            ['banyak', 'sedang', 'cepat', 'Aman'],

            ['banyak', 'rendah', 'lama', 'Aman'],
            ['banyak', 'rendah', 'sedang', 'Aman'],
            ['banyak', 'rendah', 'cepat', 'Aman'],

        ];

        /*
    ============================================
    INFERENSI MIN
    ============================================
    */

        $rules = [];

        foreach ($ruleBase as $index => $rule) {

            [$stok, $jual, $leadtime, $hasil] = $rule;
            $alpha = min(
                $stock[$stok],
                $sales[$jual],
                $lead[$leadtime]
            );

            $rules[] = [

                'nama' => 'R' . ($index + 1),
                'stock' => $stok,
                'penjualan' => $jual,
                'leadTime' => $leadtime,
                'alpha' => round($alpha, 2),
                'status' => $hasil,
                'z' => $output[$hasil]

            ];
        }

        return $rules;
    }

    /*
    ===================================================
    Defuzzifikasi
    ===================================================
    */

    private function defuzzification($rules)
    {
        $atas = 0;
        $bawah = 0;

        foreach ($rules as $rule) {
            $atas += $rule['alpha'] * $rule['z'];
            $bawah += $rule['alpha'];
        }

        if ($bawah == 0) {
            return 0;
        }
        return $atas / $bawah;
    }

    /*
    ===================================================
    Status
    ===================================================
    */

    private function determineStatus($score)
    {
        if ($score >= 80) {
            return "Segera Restock";
        }

        if ($score >= 50) {
            return "Perlu Dipantau";
        }

        return "Stock Aman";
    }
}
