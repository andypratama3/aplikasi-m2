<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSaranRequest;
use App\Http\Requests\UpdateSaranRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SaranRepository;
use Illuminate\Http\Request;
use App\Models\Saran;
use Auth;
use Flash;

class SaranController extends AppBaseController
{
    /** @var SaranRepository $saranRepository*/
    private $saranRepository;

    public function __construct(SaranRepository $saranRepo)
    {
        $this->middleware('permission:sarans.index', ['only' => ['index','show']]);
        $this->middleware('permission:sarans.create', ['only' => ['create','store']]);
        $this->middleware('permission:sarans.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sarans.destroy', ['only' => ['destroy']]);
        $this->saranRepository = $saranRepo;
    }

    public function index(Request $request)
    {
        // jika role pegawa
        if (Auth::user()->hasRole('pegawai')) {
            $sarans = Auth::user()->pegawai->sarans()->paginate(10);
        }else{
            $sarans = $this->saranRepository->paginate(10);
        }

        return view('sarans.index')->with('sarans', $sarans);
    }

    public function create()
    {
        return view('sarans.create');
    }

    public function store(CreateSaranRequest $request)
    {
        $input = $request->all();
        $input['pegawai_id'] = Auth::user()->pegawai->id;

        $saran = $this->saranRepository->create($input);

        Flash::success('Saran Akan Disampaikan Ke Admin.');
        return redirect(route('sarans.index'));
    }

    public function show($id)
    {
        $saran = $this->saranRepository->find($id);

        if (empty($saran)) {
            Flash::error('Saran not found');
            return redirect(route('sarans.index'));
        }

        return view('sarans.show')->with('saran', $saran);
    }

    public function edit($id)
    {
        $saran = $this->saranRepository->find($id);

        if (empty($saran)) {
            Flash::error('Saran not found');
            return redirect(route('sarans.index'));
        }

        return view('sarans.edit')->with('saran', $saran);
    }

    public function update($id, UpdateSaranRequest $request)
    {
        $saran = $this->saranRepository->find($id);

        if (empty($saran)) {
            Flash::error('Saran not found');
            return redirect(route('sarans.index'));
        }

        $input = $request->all();
        unset($input['pegawai_id']);

        $saran = $this->saranRepository->update($input, $id);

        Flash::success('Saran Sudah Diperbarui.');
        return redirect(route('sarans.index'));
    }

    public function destroy($id)
    {
        $saran = $this->saranRepository->find($id);

        if (empty($saran)) {
            Flash::error('Saran not found');
            return redirect(route('sarans.index'));
        }

        $this->saranRepository->delete($id);

        Flash::success('Saran Dihapus.');
        return redirect(route('sarans.index'));
    }
}
