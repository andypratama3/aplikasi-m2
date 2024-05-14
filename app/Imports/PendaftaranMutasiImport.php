<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Models\PendaftaranMutasiStatus;
use App\Models\PendaftaranMutasi; 
use App\Models\Pangkat;
use App\Models\Golongan;
use App\Models\PangkatGolongan;

use App\Models\Status;
use App\Models\Pegawai;
use App\Models\User;
use Flash;
use DB;

class PendaftaranMutasiImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new PendaftaranMutasi([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        $iterationCount = 1;

        foreach ($rows as $row) {
            if ($iterationCount === 1) {
                $iterationCount++;
                continue;
            }
            $iterationCount++;

            // jika nip tidak ada
            $nip = null;
            if (empty($row[2])) {
                Flash::error('NIP tidak boleh kosong, atas nama ' . $row[1]);
                continue;
            }else if(strlen($row[2]) < 18){ // jika nip kurang dari 18
                Flash::error('NIP tidak boleh kurang dari 18, atas nama ' . $row[1]);
                continue;
            }else{
                $nip = $row[2];
            }

            $splitPangkatGolongan = self::splitPangkatGolongan($row[3]);
            
            $data = [
                // user
                'name' => $row[1],
                'password' => bcrypt('12345678'), // password default '12345678
                // pegawai
                'nip' => $row[2],
                'tanggal_masuk' => $nip != null ? substr($nip, 8, 6) . '01' : null,
                'date_of_birth' => $nip != null ? substr($nip, 0, 8) : null,
                'place_of_birth' => null,
                'jenis_kelamin' => $nip != null ? substr($nip, 14, 1) == 1 ? 'pria' : 'wanita' : null,
                'address' => null,
                'pangkat_id' => $splitPangkatGolongan['pangkat_id'],
                'pangkat_golongan_id' => $splitPangkatGolongan['pangkat_golongan_id'],
                'perangkat_daerah_id' => null,
                // pendaftaran mutasi
                'pegawai_id' => $pegawai->id ?? null,
                'asal_instansi' => null,
                'jabatan_asal' => $row[4] ?? '', //jabatan lama
                'unit_kerja_asal' => null, //unit kerja lama
                'asal_instansi_detail' => $row[5] ?? '', //ini id perangkat daerah,

                'jabatan_tujuan' => $row[6] ?? '', // jabatan baru
                'unit_kerja_tujuan' => '', //unit kerja baru
                'tujuan_instansi' => null,  //ini id perangkat daerah
                'tujuan_instansi_detail' => $row[7] ?? '',
                'jenis_instansi' => 'umum',
                'alasan_mutasi' => $row[8] ?? '', // alasan mutasi
                'tanggal_masuk_berkas' => self::indonesiaDateToNumber($row[0]),
            ];

            
            $pegawai = Pegawai::where('nip', $row[2])->first();
            
            // pakai db transaksion 
            DB::transaction(function () use($pegawai,$data,$row) {
                // jika pegawai tidak ada, maka buatkan pegawai baru
                if ($pegawai == null) {
                    $data['email'] = $row[2] . '@gmail.com';
                    $user = User::create($data);
                    $user->assignRole('pegawai');
                    $data['user_id'] = $user->id;
                    $pegawai = Pegawai::create($data);
                    $data['pegawai_id'] = $pegawai->id;
                }else{
                    $data['user_id'] = $pegawai->user_id;
                    $data['pegawai_id'] = $pegawai->id;
                }

                $pendaftaranMutasi = PendaftaranMutasi::create($data); // buatkan pendaftaran mutasi baru
                $data['pendaftaran_mutasi_id'] = $pendaftaranMutasi->id;
                // approved_by disetujui oleh user yang memiliki role admin random (spatie)
                $pendaftaranMutasiStatus = PendaftaranMutasiStatus::create([
                    'pendaftaran_mutasi_id' => $pendaftaranMutasi->id,
                    'status_mutasi_id' => Status::where('nama', 'Disetujui')->first()->id,
                    'approved_by' => User::role('admin')->inRandomOrder()->first()->id,
                    'message' => 'Telah Disejutui',
                ]);
            },3);
        }

        return redirect(route('pendaftaranMutasis.index'));
    }

    // buatkan saya function memecah pangkat dan pangkat golongan contoh Penata Muda (III/a)
    public static function splitPangkatGolongan($string) : array
    {
        $array = explode(' ', $string);

        // pangkat adalah gabungan semua array kecuali yang terakhir
        if (count($array) == 2) {
            $pangkat = $array[0];
        } elseif (count($array) >= 3) {
            $pangkat = implode(' ', array_slice($array, 0, -1));
        } else {
            $pangkat = null;
        }

        // $pangkatModel = Pangkat::whereRaw('LOWER(nama) = ?', [strtolower($pangkat)])
        // ->orWhereRaw('LOWER(description) = ?', [strtolower($pangkat)])
        // ->first();

        // cari pangkat yang sesuai dengan pangkat yang diinputkan
        // terkadang 1 dan i itu sama, maka kita replace 1 dengan i dan i dengan 1
        $pangkatModel = Pangkat::where(function ($query) use ($pangkat) {
            $query->whereRaw('REPLACE(LOWER(nama), "1", "i") = ?', [strtolower($pangkat)])
                ->orWhereRaw('REPLACE(LOWER(description), "1", "i") = ?', [strtolower($pangkat)]);
        })->orWhere(function ($query) use ($pangkat) {
            $query->whereRaw('REPLACE(LOWER(nama), "i", "1") = ?', [strtolower($pangkat)])
                ->orWhereRaw('REPLACE(LOWER(description), "i", "1") = ?', [strtolower($pangkat)]);
        })->first();

        // ambil array yang terakhir
        $pangkatGolongan = end($array);
        $pangkatGolongan = str_replace(['(', ')'], '', $pangkatGolongan); // hapus kurung buka dan kurung tutup

        // cari golongan yang sesuai dengan golongan yang diinputkan
        $pangkatGolonganModel = PangkatGolongan::where('name', $pangkatGolongan)->first();

        return [
            'pangkat' => $pangkat,
            'pangkat_id' => $pangkatModel != null ? $pangkatModel->id : null,
            'golongan' => $pangkatGolongan,
            'pangkat_golongan_id' => $pangkatGolonganModel != null ? $pangkatGolonganModel->id : null,
        ];
    }

    // buatkan saya function memiliki parameter tanggal contoh 22 JUNI 2023 (bulanya bahasa indonesia) ubah ke angka
    public static function indonesiaDateToNumber($date)
    {
        $date = strtolower($date);
        $date = explode(' ', $date);
        $day = $date[0] ?? '';
        $month = $date[1] ?? '';
        $year = $date[2] ?? '';

        // jika day atau mont atau year kosong, maka kembalikan null
        if (empty($day) || empty($month) || empty($year)) {
            return null;
        }

        $month = self::indonesiaTranslateMonthToNumber($month);

        return $year . '-' . $month . '-' . $day;
    }
    

    // buatkan saya function menerjamahkan bulan dari bahasa indonesia ke bulan dalam angka
    public static function indonesiaTranslateMonthToNumber($month) : string
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
}
