<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerangkatDaerahRequest;
use App\Http\Requests\UpdatePerangkatDaerahRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PerangkatDaerahRepository;
use Illuminate\Http\Request;
use Flash;

class PerangkatDaerahController extends AppBaseController
{
    /** @var PerangkatDaerahRepository $perangkatDaerahRepository*/
    private $perangkatDaerahRepository;

    public function __construct(PerangkatDaerahRepository $perangkatDaerahRepo)
    {
        $this->middleware('permission:perangkatDaerahs.index', ['only' => ['index','show']]);
        $this->middleware('permission:perangkatDaerahs.create', ['only' => ['create','store']]);
        $this->middleware('permission:perangkatDaerahs.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:perangkatDaerahs.destroy', ['only' => ['destroy']]);
        $this->perangkatDaerahRepository = $perangkatDaerahRepo;
    }

    /**
     * Display a listing of the PerangkatDaerah.
     */
    public function index(Request $request)
    {
        $perangkatDaerahs = $this->perangkatDaerahRepository->paginate(10);

        return view('perangkat_daerahs.index')
            ->with('perangkatDaerahs', $perangkatDaerahs);
    }

    /**
     * Show the form for creating a new PerangkatDaerah.
     */
    public function create()
    {
        return view('perangkat_daerahs.create');
    }

    /**
     * Store a newly created PerangkatDaerah in storage.
     */
    public function store(CreatePerangkatDaerahRequest $request)
    {
        $input = $request->all();

        $perangkatDaerah = $this->perangkatDaerahRepository->create($input);

        Flash::success('Perangkat Daerah saved successfully.');

        return redirect(route('perangkatDaerahs.index'));
    }

    /**
     * Display the specified PerangkatDaerah.
     */
    public function show($id)
    {
        $perangkatDaerah = $this->perangkatDaerahRepository->find($id);

        if (empty($perangkatDaerah)) {
            Flash::error('Perangkat Daerah not found');

            return redirect(route('perangkatDaerahs.index'));
        }

        return view('perangkat_daerahs.show')->with('perangkatDaerah', $perangkatDaerah);
    }

    /**
     * Show the form for editing the specified PerangkatDaerah.
     */
    public function edit($id)
    {
        $perangkatDaerah = $this->perangkatDaerahRepository->find($id);

        if (empty($perangkatDaerah)) {
            Flash::error('Perangkat Daerah not found');

            return redirect(route('perangkatDaerahs.index'));
        }

        return view('perangkat_daerahs.edit')->with('perangkatDaerah', $perangkatDaerah);
    }

    /**
     * Update the specified PerangkatDaerah in storage.
     */
    public function update($id, UpdatePerangkatDaerahRequest $request)
    {
        $perangkatDaerah = $this->perangkatDaerahRepository->find($id);

        if (empty($perangkatDaerah)) {
            Flash::error('Perangkat Daerah not found');

            return redirect(route('perangkatDaerahs.index'));
        }

        $perangkatDaerah = $this->perangkatDaerahRepository->update($request->all(), $id);

        Flash::success('Perangkat Daerah updated successfully.');

        return redirect(route('perangkatDaerahs.index'));
    }

    /**
     * Remove the specified PerangkatDaerah from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $perangkatDaerah = $this->perangkatDaerahRepository->find($id);

        if (empty($perangkatDaerah)) {
            Flash::error('Perangkat Daerah not found');

            return redirect(route('perangkatDaerahs.index'));
        }

        $this->perangkatDaerahRepository->delete($id);

        Flash::success('Perangkat Daerah deleted successfully.');

        return redirect(route('perangkatDaerahs.index'));
    }
}
