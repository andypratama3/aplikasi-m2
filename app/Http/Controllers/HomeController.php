<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranMutasi;
use App\Models\Pegawai;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendaftaranMutasis = PendaftaranMutasi::all();

        $jumlahPendaftaranMutasi = $pendaftaranMutasis->count();

        $jumlahMutasiDisetujui = 0;
        $jumlahMutasiDitolak = 0;
        $jumlahMutasiDiproses = 0;
        $jumlahMutasiDraft = 0;

        $tujuanInstansiPendidikan = 0;
        $tujuanInstansiKesehatan = 0;
        $tujuanInstansiTeknis = 0;
        
        foreach ($pendaftaranMutasis as $pendaftaranMutasi) {
            
            $statusMutasi = $pendaftaranMutasi->pendaftaranMutasiStatuses->last()->statusMutasi->nama;
            $statusMutasi == 'Disetujui' ? $jumlahMutasiDisetujui++ : null;
            $statusMutasi == 'Ditolak' ? $jumlahMutasiDitolak++ : null;
            $statusMutasi == 'Proses' ? $jumlahMutasiDiproses++ : null;
            $statusMutasi == 'Draft' ? $jumlahMutasiDraft++ : null;

            $tujuanInstansi = $pendaftaranMutasi->tujuanInstansi->jenis_instansi ?? null;

            $tujuanInstansi == 'pendidikan' ? $tujuanInstansiPendidikan++ : null;
            $tujuanInstansi == 'kesehatan' ? $tujuanInstansiKesehatan++ : null;
            $tujuanInstansi == 'umum' ? $tujuanInstansiTeknis++ : null;
            
        }

        // return $pendaftaranMutasis;

        $pegawais = Pegawai::all();

        $jumlahPns = $pegawais->count();
        $jumlahLaki = $pegawais->where('jenis_kelamin', 'pria')->count();
        $jumlahWanita = $pegawais->where('jenis_kelamin', 'wanita')->count();
        
        return view('home', compact(
            'jumlahPendaftaranMutasi',
            'jumlahMutasiDisetujui',
            'jumlahMutasiDitolak',
            'jumlahMutasiDiproses',
            'jumlahMutasiDraft',
            'tujuanInstansiPendidikan',
            'tujuanInstansiKesehatan',
            'tujuanInstansiTeknis',
            'jumlahPns',
            'jumlahLaki',
            'jumlahWanita'
        ));
    }

    public function showPresentation()
    {
        // Replace with the path to your presentation file
        $presentationPath = storage_path("sop.pptx");

        // Create a presentation object
        $presentation = new PhpPresentation();

        // Load the presentation file
        $slides = IOFactory::createPhpPresentationObject($presentationPath);

        // Add slides to the presentation
        foreach ($slides as $slide) {
            $presentation->addSlide(clone $slide);
        }

        // Pass the presentation to the view
        return view('presentation.show', compact('presentation'));
    }
}
