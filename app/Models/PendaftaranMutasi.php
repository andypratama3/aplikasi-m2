<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PendaftaranMutasi extends Model implements HasMedia, FromCollection, WithHeadings, WithMapping, WithEvents
{
    use InteractsWithMedia;

    public $table = 'pendaftaran_mutasi';

    public $fillable = [
        'pegawai_id',
        'asal_instansi',
        'jabatan_asal',
        'unit_kerja_asal',
        'asal_instansi_detail',
        'tujuan_instansi',
        'jabatan_tujuan',
        'unit_kerja_tujuan',
        'tujuan_instansi_detail',
        'jenis_instansi',
        'alasan_mutasi',
        'tanggal_masuk_berkas'
    ];

    protected $casts = [
        'tipe' => 'string',
        'alasan_mutasi' => 'string',
        'jabatan_asal' => 'string',
        'jabatan_tujuan' => 'string',
        'unit_kerja_asal' => 'string',
        'unit_kerja_tujuan' => 'string',
        'asal_instansi_detail' => 'string',
        'tujuan_instansi_detail' => 'string',
        'tanggal_masuk_berkas' => 'date',
    ];

    public static array $rules = [
        'pegawai_id' => 'required',
        'tujuan_instansi' => '',
        'asal_instansi' => '',
        'jenis_instansi' => 'required',
        'alasan_mutasi' => 'nullable|string|max:65535',
        'jabatan_asal' => 'nullable|string|max:255',
        'jabatan_tujuan' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function tujuanInstansi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PerangkatDaerah::class, 'tujuan_instansi');
    }

    public function asalInstansi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PerangkatDaerah::class, 'asal_instansi');
    }

    public function pegawai(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Pegawai::class, 'pegawai_id');
    }

    public function pendaftaranMutasiStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PendaftaranMutasiStatus::class, 'pendaftaran_mutasi_id');
    }

    public function collection()
    {
        return PendaftaranMutasi::all();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Pangkat',
            'Tujuan Instansi',
            'Asal Instansi',
            'Jabatan Asal',
            'Jabatan Tujuan',
            'Jenis Instansi',
            // 'Unit Kerja Asal',
            // 'Unit Kerja Tujuan',
            'Unit kerja/Bidang/Kelurahan (Asal)', //'Asal Instansi Detail',
            'Unit kerja/Bidang/Kelurahan (Tujuan)', // 'Tujuan Instansi Detail',
            'Dubuat Pada',
            'Disetujui / Ditolak',
            'Keterangan',
        ];
    }

    public function map($pendaftaranMutasi): array
    {
        $lastStatus = $pendaftaranMutasi->pendaftaranMutasiStatuses->last();

        // Periksa apakah statusMutasi 'Disetujui' atau 'Ditolak'
        if ($lastStatus && in_array($lastStatus->statusMutasi->nama, ['Disetujui', 'Ditolak'])) {
            return [
                $pendaftaranMutasi->pegawai->user->name ?? '',
                '`' . $pendaftaranMutasi->pegawai->nip ?? '',
                ($pendaftaranMutasi->pegawai->pangkat->nama ?? '') . ' ' . ($pendaftaranMutasi->pegawai->pangkatGolongan->name ?? ''),
                $pendaftaranMutasi->tujuanInstansi->nama ?? '',
                $pendaftaranMutasi->asalInstansi->nama ?? '',
                $pendaftaranMutasi->jabatan_asal ?? '',
                $pendaftaranMutasi->jabatan_tujuan ?? '',
                $pendaftaranMutasi->jenis_instansi ?? '',
                // $pendaftaranMutasi->unit_kerja_asal ?? '',
                // $pendaftaranMutasi->unit_kerja_tujuan ?? '',
                $pendaftaranMutasi->asal_instansi_detail ?? '',
                $pendaftaranMutasi->tujuan_instansi_detail ?? '',
                $lastStatus->created_at?->format('d/m/Y') ?? '',
                $lastStatus->statusMutasi->nama ?? '',
                $pendaftaranMutasi->alasan_mutasi ?? '',
            ];
        }

        // Jika tidak memenuhi kriteria, kembalikan array kosong
        return [];
    }

    // Implementasikan metode AfterSheet untuk menyesuaikan lebar kolom
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Sesuaikan lebar kolom sesuai kebutuhan
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(19);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(30);
                // Otomatis atur lebar kolom
                $event->sheet->getDelegate()->getSheetView()->setZoomScale(100);
            },
        ];
    }


    // buatkan saya function menerjamahkan bulan dari bahasa indonesia ke bulan dalam angka
    public static function indonesiaTranslateMonthToNumber($month)
    {
        $month = strtolower($month);
        switch ($month) {
            case 'januari':
                return '01';
                break;
            case 'februari':
                return '02';
                break;
            case 'maret':
                return '03';
                break;
            case 'april':
                return '04';
                break;
            case 'mei':
                return '05';
                break;
            case 'juni':
                return '06';
                break;
            case 'juli':
                return '07';
                break;
            case 'agustus':
                return '08';
                break;
            case 'september':
                return '09';
                break;
            case 'oktober':
                return '10';
                break;
            case 'november':
                return '11';
                break;
            case 'desember':
                return '12';
                break;
            default:
                return '01';
                break;
        }
    }

    // buatkan saya function menerjemahkan bulan dari bahasa indonesia ke bahasa inggris
    public static function translateMonth($month)
    {
        $month = strtolower($month);
        switch ($month) {
            case 'januari':
                return 'january';
                break;
            case 'februari':
                return 'february';
                break;
            case 'maret':
                return 'march';
                break;
            case 'april':
                return 'april';
                break;
            case 'mei':
                return 'may';
                break;
            case 'juni':
                return 'june';
                break;
            case 'juli':
                return 'july';
                break;
            case 'agustus':
                return 'august';
                break;
            case 'september':
                return 'september';
                break;
            case 'oktober':
                return 'october';
                break;
            case 'november':
                return 'november';
                break;
            case 'desember':
                return 'december';
                break;
            default:
                return 'january';
                break;
        }
    }
    
}
