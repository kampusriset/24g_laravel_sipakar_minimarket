<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
        }

        th {
            background: #f3f3f3;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>SMART MINIMARKET AI</h2>

    <p>
        Invoice :
        <b>{{ $sale->invoice_number }}</b>
    </p>

    <p>
        Tanggal :
        {{ \Carbon\Carbon::parse($sale->tanggal)->format('d-m-Y H:i') }}
    </p>

    <p>
        Kasir :
        {{ $sale->user->name }}
    </p>

    <table>

        <thead>

            <tr>

                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach($sale->saleDetails as $detail)

            <tr>

                <td>{{ $detail->product->nama_produk }}</td>

                <td class="center">

                    {{ $detail->qty }}

                </td>

                <td class="right">

                    Rp {{ number_format($detail->harga,0,',','.') }}

                </td>

                <td class="right">

                    Rp {{ number_format($detail->subtotal,0,',','.') }}

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    <br>

    <table>

        <tr>

            <td width="70%">
                <b>Total</b>
            </td>

            <td class="right">

                Rp {{ number_format($sale->total_harga,0,',','.') }}

            </td>

        </tr>

        <tr>

            <td>

                Bayar

            </td>

            <td class="right">

                Rp {{ number_format($sale->payment->jumlah_bayar,0,',','.') }}

            </td>

        </tr>

        <tr>

            <td>

                Kembalian

            </td>

            <td class="right">

                Rp {{ number_format($sale->payment->kembalian,0,',','.') }}

            </td>

        </tr>

    </table>

    <a href="{{ route('history.pdf',$sale) }}"
        class="bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-lg">

        Download PDF

    </a>

    <br><br>

    <p style="text-align:center">

        Terima kasih telah berbelanja.

    </p>

</body>

</html>