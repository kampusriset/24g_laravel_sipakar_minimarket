<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan.
     */
    public function index(Request $request)
    {
        // Ambil tanggal dari filter.
        // Jika tidak ada, gunakan awal dan akhir bulan berjalan.
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth()->startOfDay();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth()->endOfDay();


        // Ambil data transaksi
        $sales = Sale::with([
                'user',
                'saleDetails.product'
            ])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->paginate(15)
            ->withQueryString();


        // Total transaksi
        $totalTransaksi = $sales->total();


        // Total barang yang terjual
        $totalBarang = $sales->getCollection()
            ->sum(function ($sale) {
                return $sale->saleDetails->sum('qty');
            });


        // Total penjualan
        $totalPenjualan = $sales->getCollection()
            ->sum(function ($sale) {
                return $sale->total_harga;
            });


        $summary = [
            'totalTransaksi' => $totalTransaksi,
            'totalBarang' => $totalBarang,
            'totalPenjualan' => $totalPenjualan,
        ];


        return view('laporan.index', compact(
            'sales',
            'summary',
            'startDate',
            'endDate'
        ));
    }


    /**
     * Download laporan dalam bentuk PDF.
     */
    public function pdf(Request $request)
    {
        // Ambil tanggal filter
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth()->startOfDay();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth()->endOfDay();


        // Ambil seluruh transaksi.
        // Tidak menggunakan paginate karena semua data
        // harus masuk ke laporan PDF.
        $sales = Sale::with([
                'user',
                'saleDetails.product'
            ])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();


        // Hitung total transaksi
        $totalTransaksi = $sales->count();


        // Hitung total barang
        $totalBarang = $sales->sum(function ($sale) {
            return $sale->saleDetails->sum('qty');
        });


        // Hitung total penjualan
        $totalPenjualan = $sales->sum(function ($sale) {
            return $sale->total_harga;
        });


        $summary = [
            'totalTransaksi' => $totalTransaksi,
            'totalBarang' => $totalBarang,
            'totalPenjualan' => $totalPenjualan,
        ];


        // Buat PDF dari Blade
        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'sales',
                'summary',
                'startDate',
                'endDate'
            )
        );


        // Ukuran kertas
        $pdf->setPaper('A4', 'landscape');


        // Download PDF
        return $pdf->download(
            'laporan-penjualan-' .
            $startDate->format('Y-m-d') .
            '-sampai-' .
            $endDate->format('Y-m-d') .
            '.pdf'
        );
    }


    /**
     * Download laporan dalam bentuk Excel.
     */
    public function excel(Request $request)
    {
        // Ambil tanggal filter
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth()->startOfDay();

        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth()->endOfDay();


        // Ambil seluruh transaksi
        $sales = Sale::with([
                'user',
                'saleDetails.product'
            ])
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->get();


        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Laporan Penjualan');


        // =========================
        // JUDUL
        // =========================

        $sheet->setCellValue(
            'A1',
            'MARTIN - LAPORAN PENJUALAN'
        );

        $sheet->setCellValue(
            'A2',
            'Periode: ' .
            $startDate->format('d/m/Y') .
            ' - ' .
            $endDate->format('d/m/Y')
        );


        // =========================
        // RINGKASAN
        // =========================

        $totalTransaksi = $sales->count();

        $totalBarang = $sales->sum(function ($sale) {
            return $sale->saleDetails->sum('qty');
        });

        $totalPenjualan = $sales->sum(function ($sale) {
            return $sale->total_harga;
        });


        $sheet->setCellValue(
            'A4',
            'Total Transaksi'
        );

        $sheet->setCellValue(
            'B4',
            $totalTransaksi
        );


        $sheet->setCellValue(
            'A5',
            'Barang Terjual'
        );

        $sheet->setCellValue(
            'B5',
            $totalBarang
        );


        $sheet->setCellValue(
            'A6',
            'Total Penjualan'
        );

        $sheet->setCellValue(
            'B6',
            $totalPenjualan
        );


        // =========================
        // HEADER TABEL
        // =========================

        $row = 8;

        $headers = [
            'No',
            'Tanggal',
            'Invoice',
            'Kasir',
            'Jumlah Barang',
            'Total Penjualan',
            'Status'
        ];


        $column = 'A';

        foreach ($headers as $header) {

            $sheet->setCellValue(
                $column . $row,
                $header
            );

            $column++;
        }


        // =========================
        // DATA TRANSAKSI
        // =========================

        $row = 9;

        $no = 1;


        foreach ($sales as $sale) {

            $jumlahBarang = $sale->saleDetails->sum('qty');


            $sheet->setCellValue(
                'A' . $row,
                $no
            );


            $sheet->setCellValue(
                'B' . $row,
                $sale->tanggal
                    ? Carbon::parse($sale->tanggal)
                        ->format('d/m/Y H:i')
                    : '-'
            );


            $sheet->setCellValue(
                'C' . $row,
                $sale->invoice_number ?? '-'
            );


            $sheet->setCellValue(
                'D' . $row,
                $sale->user?->name ?? '-'
            );


            $sheet->setCellValue(
                'E' . $row,
                $jumlahBarang
            );


            $sheet->setCellValue(
                'F' . $row,
                $sale->total_harga
            );


            $sheet->setCellValue(
                'G' . $row,
                ucfirst($sale->status ?? '-')
            );


            $row++;
            $no++;
        }


        // =========================
        // STYLE
        // =========================

        $sheet->getStyle('A1:G1')
            ->getFont()
            ->setBold(true)
            ->setSize(16);


        $sheet->getStyle('A8:G8')
            ->getFont()
            ->setBold(true);


        $sheet->getStyle('A8:G8')
            ->getAlignment()
            ->setHorizontal('center');


        // Format Rupiah
        if ($row > 9) {

            $sheet->getStyle('F9:F' . ($row - 1))
                ->getNumberFormat()
                ->setFormatCode(
                    '#,##0'
                );
        }


        // Lebar kolom otomatis
        foreach (range('A', 'G') as $column) {

            $sheet->getColumnDimension($column)
                ->setAutoSize(true);
        }


        // =========================
        // DOWNLOAD EXCEL
        // =========================

        $fileName =
            'laporan-penjualan-' .
            $startDate->format('Y-m-d') .
            '-sampai-' .
            $endDate->format('Y-m-d') .
            '.xlsx';


        $writer = new Xlsx($spreadsheet);


        // Simpan sementara
        $tempFile = tempnam(
            sys_get_temp_dir(),
            'laporan_'
        );

        $writer->save($tempFile);


        return response()
            ->download(
                $tempFile,
                $fileName,
                [
                    'Content-Type' =>
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ]
            )
            ->deleteFileAfterSend(true);
    }
}