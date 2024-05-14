<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Jabatan;
use App\Models\PageCategory;
use App\Repositories\JabatanRepository;
use Illuminate\Http\Request;
use Flash;

class JabatanController extends AppBaseController
{
    /** @var JabatanRepository $jabatanRepository*/
    private $jabatanRepository;

    public function __construct(JabatanRepository $jabatanRepo)
    {
        $this->middleware('permission:jabatans.index', ['only' => ['index','show']]);
        $this->middleware('permission:jabatans.create', ['only' => ['create','store']]);
        $this->middleware('permission:jabatans.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:jabatans.destroy', ['only' => ['destroy']]);
        $this->jabatanRepository = $jabatanRepo;
    }

    /**
     * Display a listing of the Jabatan.
     */
    public function index(Request $request)
    {
        $jabatans = $this->jabatanRepository->paginate(10);

        return view('jabatans.index')
            ->with('jabatans', $jabatans);
    }

    /**
     * Show the form for creating a new Jabatan.
     */
    public function create()
    {
        $parent = Jabatan::pluck('name','id');
        return view('jabatans.create',compact('parent'));
    }

    /**
     * Store a newly created Jabatan in storage.
     */
    public function store(CreateJabatanRequest $request)
    {
        $input = $request->all();
//        dd($input);

        $this->jabatanRepository->create($input);
//        Jabatan::fixTree();
        Flash::success('Jabatan saved successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Display the specified Jabatan.
     */
    public function show($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        return view('jabatans.show')->with('jabatan', $jabatan);
    }

    /**
     * Show the form for editing the specified Jabatan.
     */
    public function edit($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $parent = Jabatan::pluck('name','id');
        return view('jabatans.edit',compact('parent'))->with('jabatan', $jabatan);
    }

    /**
     * Update the specified Jabatan in storage.
     */
    public function update($id, UpdateJabatanRequest $request)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $jabatan = $this->jabatanRepository->update($request->all(), $id);
        Jabatan::fixTree();

        Flash::success('Jabatan updated successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Remove the specified Jabatan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $jabatan = $this->jabatanRepository->find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $this->jabatanRepository->delete($id);

        Flash::success('Jabatan deleted successfully.');

        return redirect(route('jabatans.index'));
    }
    public function increase($id)
    {
        $jabatan = Jabatan::find($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');
            return redirect(route('jabatans.index'));
        }

        if($jabatan->order>0){
            $jabatan->order=$jabatan->order-1;
            $jabatan->save();

            Flash::success('Urutan Berhasil Naik');
        }else{
            Flash::error('Urutan mencapai nilai batas');
        }

        return redirect(route('jabatans.index'));
    }

    public function decrease($id)
    {
        $jabatan = Jabatan::find($id);

        if (empty($jabatan)) {
            Flash::error('jabatan not found');
            return redirect(route('jabatans.index'));
        }

        $jabatan->order=$jabatan->order+1;
        $jabatan->save();
        Flash::success('Urutan Berhasil Turun');

        return redirect(route('jabatans.index'));
    }
}
