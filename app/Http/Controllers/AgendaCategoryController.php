<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAgendaCategoryRequest;
use App\Http\Requests\UpdateAgendaCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AgendaCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class AgendaCategoryController extends AppBaseController
{
    /** @var AgendaCategoryRepository $agendaCategoryRepository*/
    private $agendaCategoryRepository;

    public function __construct(AgendaCategoryRepository $agendaCategoryRepo)
    {
        $this->middleware('permission:agendaCategories.index', ['only' => ['index','show']]);
        $this->middleware('permission:agendaCategories.create', ['only' => ['create','store']]);
        $this->middleware('permission:agendaCategories.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:agendaCategories.destroy', ['only' => ['destroy']]);
        $this->agendaCategoryRepository = $agendaCategoryRepo;
    }

    /**
     * Display a listing of the AgendaCategory.
     */
    public function index(Request $request)
    {
        $agendaCategories = $this->agendaCategoryRepository->paginate(10);

        return view('agenda_categories.index')
            ->with('agendaCategories', $agendaCategories);
    }

    /**
     * Show the form for creating a new AgendaCategory.
     */
    public function create()
    {
        return view('agenda_categories.create');
    }

    /**
     * Store a newly created AgendaCategory in storage.
     */
    public function store(CreateAgendaCategoryRequest $request)
    {
        $input = $request->all();

        $agendaCategory = $this->agendaCategoryRepository->create($input);

        Flash::success('Agenda Category saved successfully.');

        return redirect(route('agendaCategories.index'));
    }

    /**
     * Display the specified AgendaCategory.
     */
    public function show($id)
    {
        $agendaCategory = $this->agendaCategoryRepository->find($id);

        if (empty($agendaCategory)) {
            Flash::error('Agenda Category not found');

            return redirect(route('agendaCategories.index'));
        }

        return view('agenda_categories.show')->with('agendaCategory', $agendaCategory);
    }

    /**
     * Show the form for editing the specified AgendaCategory.
     */
    public function edit($id)
    {
        $agendaCategory = $this->agendaCategoryRepository->find($id);

        if (empty($agendaCategory)) {
            Flash::error('Agenda Category not found');

            return redirect(route('agendaCategories.index'));
        }

        return view('agenda_categories.edit')->with('agendaCategory', $agendaCategory);
    }

    /**
     * Update the specified AgendaCategory in storage.
     */
    public function update($id, UpdateAgendaCategoryRequest $request)
    {
        $agendaCategory = $this->agendaCategoryRepository->find($id);

        if (empty($agendaCategory)) {
            Flash::error('Agenda Category not found');

            return redirect(route('agendaCategories.index'));
        }

        $agendaCategory = $this->agendaCategoryRepository->update($request->all(), $id);

        Flash::success('Agenda Category updated successfully.');

        return redirect(route('agendaCategories.index'));
    }

    /**
     * Remove the specified AgendaCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $agendaCategory = $this->agendaCategoryRepository->find($id);

        if (empty($agendaCategory)) {
            Flash::error('Agenda Category not found');

            return redirect(route('agendaCategories.index'));
        }

        $this->agendaCategoryRepository->delete($id);

        Flash::success('Agenda Category deleted successfully.');

        return redirect(route('agendaCategories.index'));
    }
}
