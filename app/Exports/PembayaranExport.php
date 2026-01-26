<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PembayaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $pembayaran;
    protected $rowNumber = 0;

    public function __construct($pembayaran = null)
    {
        $this->pembayaran = $pembayaran;
    }

    /**
     * Mengambil data pembayaran
     */
    public function collection()
    {
        if ($this->pembayaran) {
            return $this->pembayaran;
        }

        return Pembayaran::with(['siswa', 'petugas', 'spp'])
            ->orderBy('tgl_bayar', 'DESC')
            ->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal Bayar',
            'NISN',
            'Nama Siswa',
            'Kelas',
            'Bulan',
            'Tahun',
            'Nominal SPP',
            'Jumlah Bayar',
            'Metode',
            'Bank Tujuan',
            'No. Rek Pengirim',
            'Nama Pengirim',
            'Tanggal Transfer',
            'Petugas',
            'Catatan'
        ];
    }

    /**
     * Mapping data ke kolom
     */
    public function map($pembayaran): array
    {
        $this->rowNumber++;
        
        return [
            $this->rowNumber,
            \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y'),
            $pembayaran->nisn,
            $pembayaran->siswa->nama ?? '-',
            $pembayaran->siswa->kelas->nama_kelas ?? '-',
            $pembayaran->bulan_dibayar,
            $pembayaran->tahun_dibayar,
            'Rp ' . number_format($pembayaran->spp->nominal ?? 0, 0, ',', '.'),
            'Rp ' . number_format($pembayaran->jumlah_bayar, 0, ',', '.'),
            strtoupper($pembayaran->metode_pembayaran ?? 'TUNAI'),
            $pembayaran->bank_tujuan ?? '-',
            $pembayaran->no_rekening_pengirim ?? '-',
            $pembayaran->nama_pengirim ?? '-',
            $pembayaran->tanggal_transfer ? \Carbon\Carbon::parse($pembayaran->tanggal_transfer)->format('d/m/Y') : '-',
            $pembayaran->petugas->nama_petugas ?? '-',
            $pembayaran->catatan ?? '-'
        ];
    }

    /**
     * Styling Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:P1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '001f3f'] // Navy Blue
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);

        // Tinggi baris header
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Style untuk semua data
        $lastRow = $this->rowNumber + 1;
        $sheet->getStyle('A1:P' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC']
                ]
            ]
        ]);

        // Alignment untuk kolom nomor dan tanggal
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B2:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('F2:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('J2:J' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('N2:N' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Alignment untuk nominal (right)
        $sheet->getStyle('H2:I' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        return [];
    }

    /**
     * Nama sheet
     */
    public function title(): string
    {
        return 'Laporan Pembayaran SPP';
    }
}