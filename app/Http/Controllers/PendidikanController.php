<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePendidikanRequest;
use App\Http\Requests\UpdatePendidikanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PendidikanRepository;
use Illuminate\Http\Request;
use Flash;

class PendidikanController extends AppBaseController
{
    /** @var PendidikanRepository $pendidikanRepository*/
    private $pendidikanRepository;

    public function __construct(PendidikanRepository $pendidikanRepo)
    {
        $this->middleware('permission:pendidikans.index', ['only' => ['index','show']]);
        $this->middleware('permission:pendidikans.create', ['only' => ['create','store']]);
        $this->middleware('permission:pendidikans.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pendidikans.destroy', ['only' => ['destroy']]);
        $this->pendidikanRepository = $pendidikanRepo;
    }

    /**
     * Display a listing of the Pendidikan.
     */
    public function index(Request $request)
    {
        $pendidikans = $this->pendidikanRepository->paginate(10);

        return view('pendidikans.index')
            ->with('pendidikans', $pendidikans);
    }

    /**
     * Show the form for creating a new Pendidikan.
     */
    public function create()
    {
        return view('pendidikans.create');
    }

    /**
     * Store a newly created Pendidikan in storage.
     */
    public function store(CreatePendidikanRequest $request)
    {
        $input = $request->all();

        $pendidikan = $this->pendidikanRepository->create($input);

        Flash::success('Pendidikan saved successfully.');

        return redirect(route('pendidikans.index'));
    }

    /**
     * Display the specified Pendidikan.
     */
    public function show($id)
    {
        $pendidikan = $this->pendidikanRepository->find($id);

        if (empty($pendidikan)) {
            Flash::error('Pendidikan not found');

            return redirect(route('pendidikans.index'));
        }

        return view('pendidikans.show')->with('pendidikan', $pendidikan);
    }

    /**
     * Show the form for editing the specified Pendidikan.
     */
    public function edit($id)
    {
        $pendidikan = $this->pendidikanRepository->find($id);

        if (empty($pendidikan)) {
            Flash::error('Pendidikan not found');

            return redirect(route('pendidikans.index'));
        }

        return view('pendidikans.edit')->with('pendidikan', $pendidikan);
    }

    /**
     * Update the specified Pendidikan in storage.
     */
    public function update($id, UpdatePendidikanRequest $request)
    {
        $pendidikan = $this->pendidikanRepository->find($id);

        if (empty($pendidikan)) {
            Flash::error('Pendidikan not found');

            return redirect(route('pendidikans.index'));
        }

        $pendidikan = $this->pendidikanRepository->update($request->all(), $id);

        Flash::success('Pendidikan updated successfully.');

        return redirect(route('pendidikans.index'));
    }

    /**
     * Remove the specified Pendidikan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pendidikan = $this->pendidikanRepository->find($id);

        if (empty($pendidikan)) {
            Flash::error('Pendidikan not found');

            return redirect(route('pendidikans.index'));
        }

        $this->pendidikanRepository->delete($id);

        Flash::success('Pendidikan deleted successfully.');

        return redirect(route('pendidikans.index'));
    }
}
