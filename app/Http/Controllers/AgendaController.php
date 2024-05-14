<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAgendaRequest;
use App\Http\Requests\UpdateAgendaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\AgendaCategory;
use App\Repositories\AgendaRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class AgendaController extends AppBaseController
{
    /** @var AgendaRepository $agendaRepository*/
    private $agendaRepository;

    public function __construct(AgendaRepository $agendaRepo)
    {
        $this->middleware('permission:agendas.index', ['only' => ['index','show']]);
        $this->middleware('permission:agendas.create', ['only' => ['create','store']]);
        $this->middleware('permission:agendas.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:agendas.destroy', ['only' => ['destroy']]);
        $this->agendaRepository = $agendaRepo;
    }

    /**
     * Display a listing of the Agenda.
     */
    public function index(Request $request)
    {
        $agendas = $this->agendaRepository->paginate(10);

        return view('agendas.index')
            ->with('agendas', $agendas);
    }

    /**
     * Show the form for creating a new Agenda.
     */
    public function create()
    {
        $agendaCategories= AgendaCategory::pluck('name','id');
        return view('agendas.create',compact('agendaCategories'));
    }

    /**
     * Store a newly created Agenda in storage.
     */
    public function store(CreateAgendaRequest $request)
    {
        $input = $request->all();
        $input['users_created_id'] = Auth::user()->id;
        $input['users_updated_id'] = Auth::user()->id;

        $agenda = $this->agendaRepository->create($input);

        Flash::success('Agenda saved successfully.');

        return redirect(route('agendas.index'));
    }

    /**
     * Display the specified Agenda.
     */
    public function show($id)
    {
        $agenda = $this->agendaRepository->find($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        return view('agendas.show')->with('agenda', $agenda);
    }

    /**
     * Show the form for editing the specified Agenda.
     */
    public function edit($id)
    {
        $agenda = $this->agendaRepository->find($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        $agendaCategories= AgendaCategory::pluck('name','id');
        return view('agendas.edit',compact('agendaCategories'))->with('agenda', $agenda);
    }

    /**
     * Update the specified Agenda in storage.
     */
    public function update($id, UpdateAgendaRequest $request)
    {
        $agenda = $this->agendaRepository->find($id);
        $input = $request->all();

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }
        $input['users_updated_id'] = Auth::user()->id;

        $agenda = $this->agendaRepository->update($input, $id);

        Flash::success('Agenda updated successfully.');

        return redirect(route('agendas.index'));
    }

    /**
     * Remove the specified Agenda from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $agenda = $this->agendaRepository->find($id);

        if (empty($agenda)) {
            Flash::error('Agenda not found');

            return redirect(route('agendas.index'));
        }

        $this->agendaRepository->delete($id);

        Flash::success('Agenda deleted successfully.');

        return redirect(route('agendas.index'));
    }
}
