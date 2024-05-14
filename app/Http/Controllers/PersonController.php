<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\PangkatGolongan;
use App\Models\Pendidikan;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;
use Flash;

class PersonController extends AppBaseController
{
    /** @var PersonRepository $personRepository*/
    private $personRepository;

    public function __construct(PersonRepository $personRepo)
    {
        $this->middleware('permission:people.index', ['only' => ['index','show']]);
        $this->middleware('permission:people.create', ['only' => ['create','store']]);
        $this->middleware('permission:people.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:people.destroy', ['only' => ['destroy']]);
        $this->personRepository = $personRepo;
    }

    /**
     * Display a listing of the Person.
     */
    public function index(Request $request)
    {
        $people = $this->personRepository->paginate(10);

        return view('people.index')
            ->with('people', $people);
    }

    /**
     * Show the form for creating a new Person.
     */
    public function create()
    {
        $jabatans = Jabatan::pluck('name','id');
        $bidangs = Bidang::pluck('name','id');
        $pendidikans = Pendidikan::pluck('name','id');
        $pangkatGolongans = PangkatGolongan::pluck('name','id');
        return view('people.create',compact('jabatans','pangkatGolongans','bidangs','pendidikans'));
    }

    /**
     * Store a newly created Person in storage.
     */
    public function store(CreatePersonRequest $request)
    {
        $input = $request->all();

        $person = $this->personRepository->create($input);
        $person->addFromMediaLibraryRequest($request->media)
            ->toMediaCollection();

        Flash::success('Person saved successfully.');

        return redirect(route('people.index'));
    }

    /**
     * Display the specified Person.
     */
    public function show($id)
    {
        $person = $this->personRepository->find($id);

        if (empty($person)) {
            Flash::error('Person not found');

            return redirect(route('people.index'));
        }

        return view('people.show')->with('person', $person);
    }

    /**
     * Show the form for editing the specified Person.
     */
    public function edit($id)
    {
        $person = $this->personRepository->find($id);

        if (empty($person)) {
            Flash::error('Person not found');

            return redirect(route('people.index'));
        }

        $jabatans = Jabatan::pluck('name','id');
        $bidangs = Bidang::pluck('name','id');
        $pendidikans = Pendidikan::pluck('name','id');
        $pangkatGolongans = PangkatGolongan::pluck('name','id');
        return view('people.edit',compact('pangkatGolongans','pendidikans','jabatans','bidangs'))->with('person', $person);
    }

    /**
     * Update the specified Person in storage.
     */
    public function update($id, UpdatePersonRequest $request)
    {
        $person = $this->personRepository->find($id);

        if (empty($person)) {
            Flash::error('Person not found');

            return redirect(route('people.index'));
        }

        $person = $this->personRepository->update($request->all(), $id);
        $person->syncFromMediaLibraryRequest($request->media)
            ->toMediaCollection();

        Flash::success('Person updated successfully.');

        return redirect(route('people.index'));
    }

    /**
     * Remove the specified Person from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $person = $this->personRepository->find($id);

        if (empty($person)) {
            Flash::error('Person not found');

            return redirect(route('people.index'));
        }

        $this->personRepository->delete($id);

        Flash::success('Person deleted successfully.');

        return redirect(route('people.index'));
    }
}
