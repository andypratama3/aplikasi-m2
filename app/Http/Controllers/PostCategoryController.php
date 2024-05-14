<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PostCategoryRepository;
use Illuminate\Http\Request;
use Flash;

class PostCategoryController extends AppBaseController
{
    /** @var PostCategoryRepository $postCategoryRepository*/
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->middleware('permission:postCategories.index', ['only' => ['index','show']]);
        $this->middleware('permission:postCategories.create', ['only' => ['create','store']]);
        $this->middleware('permission:postCategories.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:postCategories.destroy', ['only' => ['destroy']]);
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     */
    public function index(Request $request)
    {
        $postCategories = $this->postCategoryRepository->paginate(10);

        return view('post_categories.index')
            ->with('postCategories', $postCategories);
    }

    /**
     * Show the form for creating a new PostCategory.
     */
    public function create()
    {
        return view('post_categories.create');
    }

    /**
     * Store a newly created PostCategory in storage.
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();

        $postCategory = $this->postCategoryRepository->create($input);

        Flash::success('Post Category saved successfully.');

        return redirect(route('postCategories.index'));
    }

    /**
     * Display the specified PostCategory.
     */
    public function show($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('postCategories.index'));
        }

        return view('post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     */
    public function edit($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('postCategories.index'));
        }

        return view('post_categories.edit')->with('postCategory', $postCategory);
    }

    /**
     * Update the specified PostCategory in storage.
     */
    public function update($id, UpdatePostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('postCategories.index'));
        }

        $postCategory = $this->postCategoryRepository->update($request->all(), $id);

        Flash::success('Post Category updated successfully.');

        return redirect(route('postCategories.index'));
    }

    /**
     * Remove the specified PostCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Post Category not found');

            return redirect(route('postCategories.index'));
        }

        $this->postCategoryRepository->delete($id);

        Flash::success('Post Category deleted successfully.');

        return redirect(route('postCategories.index'));
    }
}
