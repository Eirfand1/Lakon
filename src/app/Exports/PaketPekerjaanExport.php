<?php

namespace App\Exports;

use App\Models\SubKegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class PaketPekerjaanExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Get all SubKegiatan records with their related PaketPekerjaan and other relationships
        $subKegiatans = SubKegiatan::with([
            'paketPekerjaan', 
            'paketPekerjaan.sekolah', 
            'paketPekerjaan.satuanKerja',
            'paketPekerjaan.dasarHukum',
            'paketPekerjaan.ppkom'
        ])->get();
        
        $rows = new Collection();
        
        foreach ($subKegiatans as $subKegiatan) {
            if ($subKegiatan->paketPekerjaan->isEmpty()) {
                $rows->push([
                    'no' => $subKegiatan->no_rekening,
                    'sub_kegiatan' => $subKegiatan->nama_sub_kegiatan,
                    'paket_id' => '',
                    'nama_paket' => '',
                    'kode_sirup' => '',
                    'sumber_dana' => '',
                    'tahun_anggaran' => '',
                    'pimpinan' => '',
                    'waktu_paket' => '',
                    'metode_pemilihan' => '',
                    'jenis_pengadaan' => '',
                    'nilai_pagu_paket' => '',
                    'nilai_hps' => '',
                    'pptkom' => '',
                    'dasar_hukum' => '',
                    'sekolah' => ''
                ]);
                continue;
            }
            
            foreach ($subKegiatan->paketPekerjaan as $index => $paket) {
                $rows->push([
                    'no' => $index === 0 ? $subKegiatan->no_rekening : '',
                    'sub_kegiatan' => $index === 0 ? $subKegiatan->nama_sub_kegiatan : '',
                    'paket_id' => $paket->paket_id,
                    'nama_paket' => $paket->nama_pekerjaan,
                    'kode_sirup' => $paket->kode_sirup,
                    'sumber_dana' => $paket->sumber_dana,
                    'tahun_anggaran' => $paket->tahun_anggaran,
                    'pimpinan' => $paket->satuanKerja->nama_pimpinan ?? '-',
                    'waktu_paket' => $paket->waktu_paket,
                    'metode_pemilihan' => $paket->metode_pemilihan,
                    'jenis_pengadaan' => $paket->jenis_pengadaan,
                    'nilai_pagu_paket' => $paket->nilai_pagu_paket,
                    'nilai_hps' => $paket->nilai_hps,
                    'ppkom' => $paket->ppkom->nama ?? '-',
                    'dasar_hukum' => $paket->dasarHukum->dasar_hukum ?? '-',
                    'sekolah' => $paket->sekolah->nama_sekolah ?? '-'
                ]);
            }
        }
        
        return $rows;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Rekening Sub Kegiatan',
            'Sub Kegiatan',
            'Nomor Paket',
            'Nama Paket Pekerjaan',
            'Kode Sirup',
            'Sumber Dana',
            'Tahun Anggaran',
            'Nama Pimpinan',
            'Waktu Paket',
            'Metode Pemilihan',
            'Jenis Pengadaan',
            'Nilai Pagu Paket',
            'Nilai HPS',
            'PPKOM',
            'Dasar Hukum',
            'Sekolah'
        ];
    }
    
    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A1';
    }
    
    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(50);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
        $sheet->getColumnDimension('L')->setWidth(15);
        $sheet->getColumnDimension('M')->setWidth(15);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(30);
        $sheet->getColumnDimension('P')->setWidth(30);
        
        $sheet->getStyle('A1:Q1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
        
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:Q' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
        
        $currentNo = null;
        $startRow = 2;
        
        for ($row = 2; $row <= $lastRow; $row++) {
            $no = $sheet->getCellByColumnAndRow(1, $row)->getValue();
            
            
            if (!empty($no)) {
                if ($currentNo !== null && $row > $startRow) {
                    $sheet->mergeCells('A' . $startRow . ':A' . ($row - 1));
                    $sheet->mergeCells('B' . $startRow . ':B' . ($row - 1));
                    
                    $sheet->getStyle('A' . $startRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $sheet->getStyle('B' . $startRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }
                
                $currentNo = $no;
                $startRow = $row;
            }
        }
        
        if ($currentNo !== null && $lastRow >= $startRow) {
            $sheet->mergeCells('A' . $startRow . ':A' . $lastRow);
            $sheet->mergeCells('B' . $startRow . ':B' . $lastRow);
            $sheet->getStyle('A' . $startRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('B' . $startRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }
        
        $sheet->getStyle('A1:Q' . $lastRow)->getAlignment()->setWrapText(true);
    }
}