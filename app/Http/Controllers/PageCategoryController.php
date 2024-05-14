<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageCategoryRequest;
use App\Http\Requests\UpdatePageCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Page;
use App\Models\PageCategory;
use App\Repositories\PageCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class PageCategoryController extends AppBaseController
{
    /** @var PageCategoryRepository $pageCategoryRepository*/
    private $pageCategoryRepository;

    public function __construct(PageCategoryRepository $pageCategoryRepo)
    {
        $this->middleware('permission:pageCategories.index', ['only' => ['index','show']]);
        $this->middleware('permission:pageCategories.create', ['only' => ['create','store']]);
        $this->middleware('permission:pageCategories.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pageCategories.destroy', ['only' => ['destroy']]);
        $this->pageCategoryRepository = $pageCategoryRepo;
    }

    /**
     * Display a listing of the PageCategory.
     */
    public function index(Request $request)
    {
        $pageCategories = $this->pageCategoryRepository->paginate(10);

        return view('page_categories.index')
            ->with('pageCategories', $pageCategories);
    }

    /**
     * Show the form for creating a new PageCategory.
     */
    public function create()
    {
        $parent = PageCategory::pluck('name','id');
        return view('page_categories.create',compact('parent'));
    }

    /**
     * Store a newly created PageCategory in storage.
     */
    public function store(CreatePageCategoryRequest $request)
    {
        $input = $request->all();

        $pageCategory = $this->pageCategoryRepository->create($input);

        Flash::success('Page Category saved successfully.');

        return redirect(route('pageCategories.index'));
    }

    /**
     * Display the specified PageCategory.
     */
    public function show($id)
    {
        $pageCategory = $this->pageCategoryRepository->find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');

            return redirect(route('pageCategories.index'));
        }

        return view('page_categories.show')->with('pageCategory', $pageCategory);
    }

    /**
     * Show the form for editing the specified PageCategory.
     */
    public function edit($id)
    {
        $pageCategory = $this->pageCategoryRepository->find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');

            return redirect(route('pageCategories.index'));
        }
        $parent = PageCategory::pluck('name','id');
        return view('page_categories.edit',compact('parent'))->with('pageCategory', $pageCategory);
    }

    /**
     * Update the specified PageCategory in storage.
     */
    public function update($id, UpdatePageCategoryRequest $request)
    {
        $pageCategory = $this->pageCategoryRepository->find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');

            return redirect(route('pageCategories.index'));
        }

        $pageCategory = $this->pageCategoryRepository->update($request->all(), $id);

        Flash::success('Page Category updated successfully.');

        return redirect(route('pageCategories.index'));
    }

    /**
     * Remove the specified PageCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pageCategory = $this->pageCategoryRepository->find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');

            return redirect(route('pageCategories.index'));
        }

        $this->pageCategoryRepository->delete($id);

        Flash::success('Page Category deleted successfully.');

        return redirect(route('pageCategories.index'));
    }
    public function increase($id)
    {
        $pageCategory = PageCategory::find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');
            return redirect(route('pageCategories.index'));
        }

        if($pageCategory->order>0){
            $pageCategory->order=$pageCategory->order-1;
            $pageCategory->save();

            Flash::success('Urutan Berhasil Naik');
        }else{
            Flash::error('Urutan mencapai nilai batas');
        }

        return redirect(route('pageCategories.index'));
    }

    public function decrease($id)
    {
        $pageCategory = PageCategory::find($id);

        if (empty($pageCategory)) {
            Flash::error('Page Category not found');
            return redirect(route('pageCategories.index'));
        }

        $pageCategory->order=$pageCategory->order+1;
        $pageCategory->save();
        Flash::success('Urutan Berhasil Turun');

        return redirect(route('pageCategories.index'));
    }

}
