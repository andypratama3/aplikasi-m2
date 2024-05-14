<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Page;
use App\Models\PageCategory;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class PageController extends AppBaseController
{
    /** @var PageRepository $pageRepository*/
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->middleware('permission:pages.index', ['only' => ['index','show']]);
        $this->middleware('permission:pages.create', ['only' => ['create','store']]);
        $this->middleware('permission:pages.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pages.destroy', ['only' => ['destroy']]);
        $this->pageRepository = $pageRepo;
    }

    /**
     * Display a listing of the Page.
     */
    public function index(Request $request)
    {
        $pages = $this->pageRepository->paginate(10);

        return view('pages.index')
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new Page.
     */
    public function create()
    {
        $parent = Page::pluck('judul','id');
        $pageCategory = PageCategory::pluck('name','id');
        return view('pages.create',compact('pageCategory','parent'));
    }

    /**
     * Store a newly created Page in storage.
     */
    public function store(CreatePageRequest $request)
    {
        $input = $request->all();

        $page = $this->pageRepository->create($input);

        Flash::success('Page saved successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * Display the specified Page.
     */
    public function show($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        return view('pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified Page.
     */
    public function edit($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }
        $parent = Page::pluck('judul','id');
        $pageCategory = PageCategory::pluck('name','id');

        return view('pages.edit',compact('parent','pageCategory'))->with('page', $page);
    }

    /**
     * Update the specified Page in storage.
     */
    public function update($id, UpdatePageRequest $request)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        $page = $this->pageRepository->update($request->all(), $id);

        Flash::success('Page updated successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * Remove the specified Page from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $page = $this->pageRepository->find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('pages.index'));
        }

        $this->pageRepository->delete($id);

        Flash::success('Page deleted successfully.');

        return redirect(route('pages.index'));
    }
    public function increase($id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page  not found');
            return redirect(route('pages.index'));
        }

        if($page->order>0){
            $page->order=$page->order-1;
            $page->save();

            Flash::success('Urutan Berhasil Naik');
        }else{
            Flash::error('Urutan mencapai nilai batas');
        }
        return redirect(route('pages.index'));

    }

    public function decrease($id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page not found');
            return redirect(route('pages.index'));
        }

        $page->order=$page->order+1;
        $page->save();
        Flash::success('Urutan Berhasil Turun');
        return redirect(route('pages.index'));
    }
}
