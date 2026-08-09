<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Penjualan
    </title>


    <style>

        @page {
            margin: 25px;
        }


        body {

            font-family: DejaVu Sans, sans-serif;

            font-size: 11px;

            color: #222;

        }


        .header {

            text-align: center;

            margin-bottom: 20px;

        }


        .header h1 {

            margin: 0;

            font-size: 20px;

        }


        .header p {

            margin-top: 5px;

            color: #666;

        }


        .summary {

            width: 100%;

            margin-bottom: 20px;

        }


        .summary td {

            width: 33.33%;

            border: 1px solid #ddd;

            padding: 10px;

        }


        .label {

            font-size: 10px;

            color: #666;

        }


        .value {

            margin-top: 5px;

            font-size: 14px;

            font-weight: bold;

        }


        table.report {

            width: 100%;

            border-collapse: collapse;

        }


        table.report th {

            background: #f5c400;

            border: 1px solid #ccc;

            padding: 8px;

            text-align: center;

        }


        table.report td {

            border: 1px solid #ccc;

            padding: 7px;

        }


        .center {

            text-align: center;

        }


        .right {

            text-align: right;

        }


        .footer {

            margin-top: 20px;

            text-align: right;

            font-size: 9px;

            color: #777;

        }

    </style>

</head>


<body>


    {{-- HEADER --}}

    <div class="header">

        <h1>
            MARTIN
        </h1>

        <h1>
            LAPORAN PENJUALAN
        </h1>

        <p>

            Periode
            {{ $startDate->format('d/m/Y') }}
            -
            {{ $endDate->format('d/m/Y') }}

        </p>

    </div>


    {{-- RINGKASAN --}}

    <table class="summary">

        <tr>

            {{-- TOTAL TRANSAKSI --}}

            <td>

                <div class="label">
                    Total Transaksi
                </div>

                <div class="value">

                    {{ number_format(
                        $summary['totalTransaksi'],
                        0,
                        ',',
                        '.'
                    ) }}

                </div>

            </td>


            {{-- BARANG TERJUAL --}}

            <td>

                <div class="label">
                    Barang Terjual
                </div>

                <div class="value">

                    {{ number_format(
                        $summary['totalBarang'],
                        0,
                        ',',
                        '.'
                    ) }}

                </div>

            </td>


            {{-- TOTAL PENJUALAN --}}

            <td>

                <div class="label">
                    Total Penjualan
                </div>

                <div class="value">

                    Rp {{ number_format(
                        $summary['totalPenjualan'],
                        0,
                        ',',
                        '.'
                    ) }}

                </div>

            </td>

        </tr>

    </table>


    {{-- TABEL TRANSAKSI --}}

    <table class="report">

        <thead>

            <tr>

                <th>
                    No
                </th>

                <th>
                    Tanggal
                </th>

                <th>
                    Invoice
                </th>

                <th>
                    Kasir
                </th>

                <th>
                    Jumlah Barang
                </th>

                <th>
                    Total Penjualan
                </th>

                <th>
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($sales as $sale)

                <tr>

                    {{-- NOMOR --}}

                    <td class="center">

                        {{ $loop->iteration }}

                    </td>


                    {{-- TANGGAL --}}

                    <td>

                        {{ $sale->tanggal->format('d/m/Y H:i') }}

                    </td>


                    {{-- INVOICE --}}

                    <td>

                        {{ $sale->invoice_number }}

                    </td>


                    {{-- KASIR --}}

                    <td>

                        {{ $sale->user?->name ?? '-' }}

                    </td>


                    {{-- JUMLAH BARANG --}}

                    <td class="center">

                        {{ $sale->saleDetails->sum('qty') }}

                    </td>


                    {{-- TOTAL --}}

                    <td class="right">

                        Rp {{ number_format(
                            $sale->total_harga,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>


                    {{-- STATUS --}}

                    <td class="center">

                        {{ ucfirst($sale->status) }}

                    </td>

                </tr>


            @empty

                <tr>

                    <td
                        colspan="7"
                        class="center">

                        Tidak ada transaksi.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- FOOTER --}}

    <div class="footer">

        Dicetak pada
        {{ now()->format('d/m/Y H:i') }}

    </div>


</body>

</html>