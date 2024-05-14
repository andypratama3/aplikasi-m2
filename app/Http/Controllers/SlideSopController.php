<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSlideSopRequest;
use App\Http\Requests\UpdateSlideSopRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SlideSopRepository;
use Illuminate\Http\Request;
use App\Models\SlideSop;
use DB;
use Auth;
use Flash;

class SlideSopController extends AppBaseController
{
    /** @var SlideSopRepository $slideSopRepository*/
    private $slideSopRepository;

    public function __construct(SlideSopRepository $slideSopRepo)
    {
        $this->middleware('permission:slideSops.index', ['only' => ['index','show']]);
        $this->middleware('permission:slideSops.create', ['only' => ['create','store']]);
        $this->middleware('permission:slideSops.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slideSops.destroy', ['only' => ['destroy']]);
        $this->slideSopRepository = $slideSopRepo;
    }


    public function index(Request $request)
    {
        if (Auth::user()->hasRole('pegawai')) {
            $slideSops = $this->slideSopRepository->all()->sortBy('halaman');
            
            return view('slide_sops.sop')->with('slideSops', $slideSops);
        }

        $slideSops = SlideSop::orderBy('halaman', 'asc')->paginate(10);
        return view('slide_sops.index')->with('slideSops', $slideSops);
    }

    public function create()
    {
        $isCreatedPage = true;
        return view('slide_sops.create', compact('isCreatedPage'));
    }

    public function store(CreateSlideSopRequest $request)
    {
        $input = $request->all();
        
        if(isset($request->gambar_slide)){
            $slideSop = $this->slideSopRepository->create($input);
            $slideSop->addFromMediaLibraryRequest($request->gambar_slide)
                ->usingName('Gambar Slide Halaman ' . $input['halaman'])
                ->toMediaCollection('gambar_slide');
            Flash::success('Slide SOP saved successfully.');    
        }else{
            Flash::error('Gambar Slide SOP tidak boleh kosong.');
        }
        
        return redirect(route('slideSops.index'));
    }

    public function show($id)
    {
        $slideSop = $this->slideSopRepository->find($id);

        if (empty($slideSop)) {
            Flash::error('Slide SOP not found');
            return redirect(route('slideSops.index'));
        }

        return view('slide_sops.show')->with('slideSop', $slideSop);
    }

    public function edit($id)
    {
        $slideSop = $this->slideSopRepository->find($id);

        if (empty($slideSop)) {
            Flash::error('Slide SOP not found');
            return redirect(route('slideSops.index'));
        }

        $isCreatedPage = false;

        return view('slide_sops.edit', compact('slideSop', 'isCreatedPage'));
    }

    public function update($id, UpdateSlideSopRequest $request)
    {
        $slideSop = $this->slideSopRepository->find($id);

        if (empty($slideSop)) {
            Flash::error('Slide SOP not found');
            return redirect(route('slideSops.index'));
        }

        $input = $request->all();

        if(isset($request->gambar_slide)){
            DB::transaction(function () use($input,$request,$id) {
                $slideSop = $this->slideSopRepository->update($request->all(), $id);
                $slideSop->syncFromMediaLibraryRequest($request->gambar_slide)->toMediaCollection('gambar_slide');
            },3);
            Flash::success('Slide SOP saved successfully.');    
        }else{
            Flash::error('Gambar Slide SOP tidak boleh kosong.');
        }

        return redirect(route('slideSops.index'));
    }

    public function destroy($id)
    {
        $slideSop = $this->slideSopRepository->find($id);

        if (empty($slideSop)) {
            Flash::error('Slide SOP not found');
            return redirect(route('slideSops.index'));
        }

        DB::transaction(function () use($id, $slideSop) {
            // hapus media dari pendaftaran mutasi
            $slideSop->getMedia()->each(function ($media) {
                $media->delete();
            });
            $slideSop->clearMediaCollection();
            $this->slideSopRepository->delete($id);
        },3);

        Flash::success('Slide SOP deleted successfully.');
        return redirect(route('slideSops.index'));
    }
}
