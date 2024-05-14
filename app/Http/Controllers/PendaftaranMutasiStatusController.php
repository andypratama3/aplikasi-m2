<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePendaftaranMutasiStatusRequest;
use App\Http\Requests\UpdatePendaftaranMutasiStatusRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PendaftaranMutasiStatusRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use App\Models\PendaftaranMutasi;
use Flash;

class PendaftaranMutasiStatusController extends AppBaseController
{
    /** @var PendaftaranMutasiStatusRepository $pendaftaranMutasiStatusRepository*/
    private $pendaftaranMutasiStatusRepository;

    public function __construct(PendaftaranMutasiStatusRepository $pendaftaranMutasiStatusRepo)
    {
        $this->middleware('permission:pendaftaranMutasiStatuses.index', ['only' => ['index','show']]);
        $this->middleware('permission:pendaftaranMutasiStatuses.create', ['only' => ['create','store']]);
        $this->middleware('permission:pendaftaranMutasiStatuses.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pendaftaranMutasiStatuses.destroy', ['only' => ['destroy']]);
        $this->pendaftaranMutasiStatusRepository = $pendaftaranMutasiStatusRepo;
    }

    /**
     * Display a listing of the PendaftaranMutasiStatus.
     */
    public function index(Request $request)
    {
        $pendaftaranMutasiStatuses = $this->pendaftaranMutasiStatusRepository->paginate(10);

        return view('pendaftaran_mutasi_statuses.index')
            ->with('pendaftaranMutasiStatuses', $pendaftaranMutasiStatuses);
    }

    /**
     * Show the form for creating a new PendaftaranMutasiStatus.
     */
    public function create()
    {
        $users = User::role('admin')->pluck('name', 'id');
        $status = Status::pluck('nama','id');
        $pendaftaranMutasis = PendaftaranMutasi::pluck('pegawai_id','id');
        return view('pendaftaran_mutasi_statuses.create',compact('status','users','pendaftaranMutasis'));
    }

    /**
     * Store a newly created PendaftaranMutasiStatus in storage.
     */
    public function store(CreatePendaftaranMutasiStatusRequest $request)
    {
        $input = $request->all();

        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->create($input);

        Flash::success('Pendaftaran Mutasi Status saved successfully.');

        return redirect(route('pendaftaranMutasiStatuses.index'));
    }

    /**
     * Display the specified PendaftaranMutasiStatus.
     */
    public function show($id)
    {
        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->find($id);

        if (empty($pendaftaranMutasiStatus)) {
            Flash::error('Pendaftaran Mutasi Status not found');

            return redirect(route('pendaftaranMutasiStatuses.index'));
        }

        return view('pendaftaran_mutasi_statuses.show')->with('pendaftaranMutasiStatus', $pendaftaranMutasiStatus);
    }

    /**
     * Show the form for editing the specified PendaftaranMutasiStatus.
     */
    public function edit($id)
    {
        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->find($id);

        if (empty($pendaftaranMutasiStatus)) {
            Flash::error('Pendaftaran Mutasi Status not found');

            return redirect(route('pendaftaranMutasiStatuses.index'));
        }

        return view('pendaftaran_mutasi_statuses.edit')->with('pendaftaranMutasiStatus', $pendaftaranMutasiStatus);
    }

    /**
     * Update the specified PendaftaranMutasiStatus in storage.
     */
    public function update($id, UpdatePendaftaranMutasiStatusRequest $request)
    {
        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->find($id);

        if (empty($pendaftaranMutasiStatus)) {
            Flash::error('Pendaftaran Mutasi Status not found');

            return redirect(route('pendaftaranMutasiStatuses.index'));
        }

        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->update($request->all(), $id);

        Flash::success('Pendaftaran Mutasi Status updated successfully.');

        return redirect(route('pendaftaranMutasiStatuses.index'));
    }

    /**
     * Remove the specified PendaftaranMutasiStatus from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pendaftaranMutasiStatus = $this->pendaftaranMutasiStatusRepository->find($id);

        if (empty($pendaftaranMutasiStatus)) {
            Flash::error('Pendaftaran Mutasi Status not found');

            return redirect(route('pendaftaranMutasiStatuses.index'));
        }

        $this->pendaftaranMutasiStatusRepository->delete($id);

        Flash::success('Pendaftaran Mutasi Status deleted successfully.');

        return redirect(route('pendaftaranMutasiStatuses.index'));
    }
}
