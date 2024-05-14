<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\KegiatanRepository;
use Illuminate\Http\Request;
use Flash;

class KegiatanController extends AppBaseController
{
    /** @var KegiatanRepository $kegiatanRepository*/
    private $kegiatanRepository;

    public function __construct(KegiatanRepository $kegiatanRepo)
    {
        $this->middleware('permission:kegiatans.index', ['only' => ['index','show']]);
        $this->middleware('permission:kegiatans.create', ['only' => ['create','store']]);
        $this->middleware('permission:kegiatans.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:kegiatans.destroy', ['only' => ['destroy']]);
        $this->kegiatanRepository = $kegiatanRepo;
    }

    /**
     * Display a listing of the Kegiatan.
     */
    public function index(Request $request)
    {
        $kegiatans = $this->kegiatanRepository->paginate(10);

        return view('kegiatans.index')
            ->with('kegiatans', $kegiatans);
    }

    /**
     * Show the form for creating a new Kegiatan.
     */
    public function create()
    {
        return view('kegiatans.create');
    }

    /**
     * Store a newly created Kegiatan in storage.
     */
    public function store(CreateKegiatanRequest $request)
    {
        $input = $request->all();

        $kegiatan = $this->kegiatanRepository->create($input);
        $kegiatan->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection();

        Flash::success('Kegiatan saved successfully.');

        return redirect(route('kegiatans.index'));
    }

    /**
     * Display the specified Kegiatan.
     */
    public function show($id)
    {
        $kegiatan = $this->kegiatanRepository->find($id);

        if (empty($kegiatan)) {
            Flash::error('Kegiatan not found');

            return redirect(route('kegiatans.index'));
        }

        return view('kegiatans.show')->with('kegiatan', $kegiatan);
    }

    /**
     * Show the form for editing the specified Kegiatan.
     */
    public function edit($id)
    {
        $kegiatan = $this->kegiatanRepository->find($id);

        if (empty($kegiatan)) {
            Flash::error('Kegiatan not found');

            return redirect(route('kegiatans.index'));
        }

        return view('kegiatans.edit')->with('kegiatan', $kegiatan);
    }

    /**
     * Update the specified Kegiatan in storage.
     */
    public function update($id, UpdateKegiatanRequest $request)
    {
        $kegiatan = $this->kegiatanRepository->find($id);

        if (empty($kegiatan)) {
            Flash::error('Kegiatan not found');

            return redirect(route('kegiatans.index'));
        }

        $kegiatan = $this->kegiatanRepository->update($request->all(), $id);
        $kegiatan->syncFromMediaLibraryRequest($request->media)
            ->toMediaCollection();

        Flash::success('Kegiatan updated successfully.');

        return redirect(route('kegiatans.index'));
    }

    /**
     * Remove the specified Kegiatan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kegiatan = $this->kegiatanRepository->find($id);

        if (empty($kegiatan)) {
            Flash::error('Kegiatan not found');

            return redirect(route('kegiatans.index'));
        }

        $this->kegiatanRepository->delete($id);

        Flash::success('Kegiatan deleted successfully.');

        return redirect(route('kegiatans.index'));
    }
}
