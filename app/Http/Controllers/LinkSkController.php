<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkSkRequest;
use App\Http\Requests\UpdateLinkSkRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LinkSkRepository;
use Illuminate\Http\Request;
use Flash;

class LinkSkController extends AppBaseController
{
    /** @var LinkSkRepository $linkSkRepository*/
    private $linkSkRepository;

    public function __construct(LinkSkRepository $linkSkRepo)
    {
        $this->middleware('permission:linkSks.index', ['only' => ['index','show']]);
        $this->middleware('permission:linkSks.create', ['only' => ['create','store']]);
        $this->middleware('permission:linkSks.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:linkSks.destroy', ['only' => ['destroy']]);
        $this->linkSkRepository = $linkSkRepo;
    }

    /**
     * Display a listing of the LinkSk.
     */
    public function index(Request $request)
    {
        $linkSks = $this->linkSkRepository->paginate(10);

        return view('link_sks.index')->with('linkSks', $linkSks);
    }

    /**
     * Show the form for creating a new LinkSk.
     */
    public function create()
    {
        return view('link_sks.create');
    }

    /**
     * Store a newly created LinkSk in storage.
     */
    public function store(CreateLinkSkRequest $request)
    {
        $input = $request->all();

        $linkSk = $this->linkSkRepository->create($input);

        Flash::success('Link Sk saved successfully.');

        return redirect(route('linkSks.index'));
    }

    /**
     * Display the specified LinkSk.
     */
    public function show($id)
    {
        $linkSk = $this->linkSkRepository->find($id);

        if (empty($linkSk)) {
            Flash::error('Link Sk not found');

            return redirect(route('linkSks.index'));
        }

        return view('link_sks.show')->with('linkSk', $linkSk);
    }

    /**
     * Show the form for editing the specified LinkSk.
     */
    public function edit($id)
    {
        $linkSk = $this->linkSkRepository->find($id);

        if (empty($linkSk)) {
            Flash::error('Link Sk not found');
            return redirect(route('linkSks.index'));
        }

        return view('link_sks.edit')->with('linkSk', $linkSk);
    }

    /**
     * Update the specified LinkSk in storage.
     */
    public function update($id, UpdateLinkSkRequest $request)
    {
        $linkSk = $this->linkSkRepository->find($id);

        if (empty($linkSk)) {
            Flash::error('Link Sk not found');

            return redirect(route('linkSks.index'));
        }

        $linkSk = $this->linkSkRepository->update($request->all(), $id);

        Flash::success('Link Sk updated successfully.');

        return redirect(route('linkSks.index'));
    }

    /**
     * Remove the specified LinkSk from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $linkSk = $this->linkSkRepository->find($id);

        if (empty($linkSk)) {
            Flash::error('Link Sk not found');

            return redirect(route('linkSks.index'));
        }

        $this->linkSkRepository->delete($id);

        Flash::success('Link Sk deleted successfully.');

        return redirect(route('linkSks.index'));
    }
}
