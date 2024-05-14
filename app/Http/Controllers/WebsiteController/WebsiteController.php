<?php

namespace App\Http\Controllers\WebsiteController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebsiteController\Utility\HeaderStatic;
use App\Models\AboutUs;
use App\Models\AksiMitigasi;
use App\Models\Berita;
use App\Models\DetailEmisiCarbon;
use App\Models\EmisiCarbon;
use App\Models\Kabkota;
use App\Models\Page;
use App\Models\Periode;
use App\Models\Testimonial;
use App\Models\Working;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use function Livewire\str;

class WebsiteController extends HeaderStatic
{
    public function index(Request $request) {
        
        return view('_website.beranda.home');
    }

    public function detailBerita($slug_berita) {
        $berita = Page::where('slug',$slug_berita)->first();
        $beritas = Page::where('page_type_id',$berita->page_type_id)->paginate(6);

        $title = $berita->judul;

        $berita->show = $berita->show + 1;
        $berita->save();

        return view('_website.id.detail_berita',compact('berita','beritas','title'));
    }
    public function page(Request $request) {
        $title = "MMR :: Berita Terkini";
        $beritas = Page::whereHas('pageType', function ($query) use ($request) {
            $query->where('nama',$request->type)->orWhere('name_english',$request->type);
        })->orderBy('created_at','asc')->get();
        $testimonial = Testimonial::get();
        $type = $request->type;

        return view('website.id.berita',compact('title','beritas','testimonial','type'));
    }

    public function artikel() {
        $title = "MMR :: Artikel Terkini";
        $beritas = Page::whereHas('pageType', function ($query) {
            $query->where('nama','artikel');
        })->orderBy('created_at','asc')->get();


        return view('_website.id.artikel',compact('title','beritas'));
    }

}
