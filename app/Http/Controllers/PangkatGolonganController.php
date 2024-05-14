<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePangkatGolonganRequest;
use App\Http\Requests\UpdatePangkatGolonganRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PangkatGolonganRepository;
use Illuminate\Http\Request;
use Flash;

class PangkatGolonganController extends AppBaseController
{
    /** @var PangkatGolonganRepository $pangkatGolonganRepository*/
    private $pangkatGolonganRepository;

    public function __construct(PangkatGolonganRepository $pangkatGolonganRepo)
    {
        $this->middleware('permission:pangkatGolongans.index', ['only' => ['index','show']]);
        $this->middleware('permission:pangkatGolongans.create', ['only' => ['create','store']]);
        $this->middleware('permission:pangkatGolongans.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pangkatGolongans.destroy', ['only' => ['destroy']]);
        $this->pangkatGolonganRepository = $pangkatGolonganRepo;
    }

    /**
     * Display a listing of the PangkatGolongan.
     */
    public function index(Request $request)
    {
        $pangkatGolongans = $this->pangkatGolonganRepository->paginate(10);

        return view('pangkat_golongans.index')
            ->with('pangkatGolongans', $pangkatGolongans);
    }

    /**
     * Show the form for creating a new PangkatGolongan.
     */
    public function create()
    {
        return view('pangkat_golongans.create');
    }

    /**
     * Store a newly created PangkatGolongan in storage.
     */
    public function store(CreatePangkatGolonganRequest $request)
    {
        $input = $request->all();

        $pangkatGolongan = $this->pangkatGolonganRepository->create($input);

        Flash::success('Pangkat Golongan saved successfully.');

        return redirect(route('pangkatGolongans.index'));
    }

    /**
     * Display the specified PangkatGolongan.
     */
    public function show($id)
    {
        $pangkatGolongan = $this->pangkatGolonganRepository->find($id);

        if (empty($pangkatGolongan)) {
            Flash::error('Pangkat Golongan not found');

            return redirect(route('pangkatGolongans.index'));
        }

        return view('pangkat_golongans.show')->with('pangkatGolongan', $pangkatGolongan);
    }

    /**
     * Show the form for editing the specified PangkatGolongan.
     */
    public function edit($id)
    {
        $pangkatGolongan = $this->pangkatGolonganRepository->find($id);

        if (empty($pangkatGolongan)) {
            Flash::error('Pangkat Golongan not found');

            return redirect(route('pangkatGolongans.index'));
        }

        return view('pangkat_golongans.edit')->with('pangkatGolongan', $pangkatGolongan);
    }

    /**
     * Update the specified PangkatGolongan in storage.
     */
    public function update($id, UpdatePangkatGolonganRequest $request)
    {
        $pangkatGolongan = $this->pangkatGolonganRepository->find($id);

        if (empty($pangkatGolongan)) {
            Flash::error('Pangkat Golongan not found');

            return redirect(route('pangkatGolongans.index'));
        }

        $pangkatGolongan = $this->pangkatGolonganRepository->update($request->all(), $id);

        Flash::success('Pangkat Golongan updated successfully.');

        return redirect(route('pangkatGolongans.index'));
    }

    /**
     * Remove the specified PangkatGolongan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pangkatGolongan = $this->pangkatGolonganRepository->find($id);

        if (empty($pangkatGolongan)) {
            Flash::error('Pangkat Golongan not found');

            return redirect(route('pangkatGolongans.index'));
        }

        $this->pangkatGolonganRepository->delete($id);

        Flash::success('Pangkat Golongan deleted successfully.');

        return redirect(route('pangkatGolongans.index'));
    }
}
