<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBidangRequest;
use App\Http\Requests\UpdateBidangRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Bidang;
use App\Repositories\BidangRepository;
use Illuminate\Http\Request;
use Flash;

class BidangController extends AppBaseController
{
    /** @var BidangRepository $bidangRepository*/
    private $bidangRepository;

    public function __construct(BidangRepository $bidangRepo)
    {
        $this->middleware('permission:bidangs.index', ['only' => ['index','show']]);
        $this->middleware('permission:bidangs.create', ['only' => ['create','store']]);
        $this->middleware('permission:bidangs.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bidangs.destroy', ['only' => ['destroy']]);
        $this->bidangRepository = $bidangRepo;
    }

    /**
     * Display a listing of the Bidang.
     */
    public function index(Request $request)
    {
        $bidangs = $this->bidangRepository->paginate(10);

        return view('bidangs.index')
            ->with('bidangs', $bidangs);
    }

    /**
     * Show the form for creating a new Bidang.
     */
    public function create()
    {
        $parent = Bidang::pluck('name','id');
        return view('bidangs.create',compact('parent'));
    }

    /**
     * Store a newly created Bidang in storage.
     */
    public function store(CreateBidangRequest $request)
    {
        $input = $request->all();

        $bidang = $this->bidangRepository->create($input);

        Flash::success('Bidang saved successfully.');

        return redirect(route('bidangs.index'));
    }

    /**
     * Display the specified Bidang.
     */
    public function show($id)
    {
        $bidang = $this->bidangRepository->find($id);

        if (empty($bidang)) {
            Flash::error('Bidang not found');

            return redirect(route('bidangs.index'));
        }

        return view('bidangs.show')->with('bidang', $bidang);
    }

    /**
     * Show the form for editing the specified Bidang.
     */
    public function edit($id)
    {
        $bidang = $this->bidangRepository->find($id);

        if (empty($bidang)) {
            Flash::error('Bidang not found');

            return redirect(route('bidangs.index'));
        }

        $parent = Bidang::pluck('name','id');
        return view('bidangs.edit',compact('parent'))->with('bidang', $bidang);
    }

    /**
     * Update the specified Bidang in storage.
     */
    public function update($id, UpdateBidangRequest $request)
    {
        $bidang = $this->bidangRepository->find($id);

        if (empty($bidang)) {
            Flash::error('Bidang not found');

            return redirect(route('bidangs.index'));
        }

        $bidang = $this->bidangRepository->update($request->all(), $id);

        Flash::success('Bidang updated successfully.');

        return redirect(route('bidangs.index'));
    }

    /**
     * Remove the specified Bidang from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bidang = $this->bidangRepository->find($id);

        if (empty($bidang)) {
            Flash::error('Bidang not found');

            return redirect(route('bidangs.index'));
        }

        $this->bidangRepository->delete($id);

        Flash::success('Bidang deleted successfully.');

        return redirect(route('bidangs.index'));
    }
}
