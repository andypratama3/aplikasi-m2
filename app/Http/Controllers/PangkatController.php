<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePangkatRequest;
use App\Http\Requests\UpdatePangkatRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PangkatRepository;
use Illuminate\Http\Request;
use Flash;

class PangkatController extends AppBaseController
{
    /** @var PangkatRepository $pangkatRepository*/
    private $pangkatRepository;

    public function __construct(PangkatRepository $pangkatRepo)
    {
        $this->middleware('permission:pangkats.index', ['only' => ['index','show']]);
        $this->middleware('permission:pangkats.create', ['only' => ['create','store']]);
        $this->middleware('permission:pangkats.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pangkats.destroy', ['only' => ['destroy']]);
        $this->pangkatRepository = $pangkatRepo;
    }

    /**
     * Display a listing of the Pangkat.
     */
    public function index(Request $request)
    {
        $pangkats = $this->pangkatRepository->paginate(10);

        return view('pangkats.index')
            ->with('pangkats', $pangkats);
    }

    /**
     * Show the form for creating a new Pangkat.
     */
    public function create()
    {
        return view('pangkats.create');
    }

    /**
     * Store a newly created Pangkat in storage.
     */
    public function store(CreatePangkatRequest $request)
    {
        $input = $request->all();

        $pangkat = $this->pangkatRepository->create($input);

        Flash::success('Pangkat saved successfully.');

        return redirect(route('pangkats.index'));
    }

    /**
     * Display the specified Pangkat.
     */
    public function show($id)
    {
        $pangkat = $this->pangkatRepository->find($id);

        if (empty($pangkat)) {
            Flash::error('Pangkat not found');

            return redirect(route('pangkats.index'));
        }

        return view('pangkats.show')->with('pangkat', $pangkat);
    }

    /**
     * Show the form for editing the specified Pangkat.
     */
    public function edit($id)
    {
        $pangkat = $this->pangkatRepository->find($id);

        if (empty($pangkat)) {
            Flash::error('Pangkat not found');

            return redirect(route('pangkats.index'));
        }

        return view('pangkats.edit')->with('pangkat', $pangkat);
    }

    /**
     * Update the specified Pangkat in storage.
     */
    public function update($id, UpdatePangkatRequest $request)
    {
        $pangkat = $this->pangkatRepository->find($id);

        if (empty($pangkat)) {
            Flash::error('Pangkat not found');

            return redirect(route('pangkats.index'));
        }

        $pangkat = $this->pangkatRepository->update($request->all(), $id);

        Flash::success('Pangkat updated successfully.');

        return redirect(route('pangkats.index'));
    }

    public function destroy($id)
    {
        $pangkat = $this->pangkatRepository->find($id);

        if (empty($pangkat)) {
            Flash::error('Pangkat not found');
            return redirect(route('pangkats.index'));
        }

        $pegawaisCount = $pangkat->pegawais()->count();

        if ($pegawaisCount > 0) {
            // Pangkat memiliki pegawai terkait, beri pesan error
            Flash::error('Pangkat Tidak bisa dihapus karna terpakai.');
            return redirect(route('pangkats.index'));
        }

        // Tidak ada pegawai terkait, bisa dihapus
        $this->pangkatRepository->delete($id);

        Flash::success('Pangkat deleted successfully.');
        return redirect(route('pangkats.index'));
    }
}
