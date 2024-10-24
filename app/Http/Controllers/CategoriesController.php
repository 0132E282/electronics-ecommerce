<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    protected $categoriesModel;
    function __construct()
    {
        $this->categoriesModel = new Categories();
    }
    /**
     *  @param type = products|blogs
     *  @param categories 
     * */
    function index($type, Categories $categories, Request $request)
    {
        $filter = [
            'search' => $request->search,
            'date' => $request->created,
        ];
        $parent = $categories->id ?? null;
        $categories = $this->categoriesModel::where('type', '=', $type)->where('parent_id', $parent)
            ->filter($filter)
            ->sort($request->sort, $request->direction)
            ->paginate(10);
        return view('pages.admin.Categories.index', ['categories' => $categories]);
    }
    /**
     *  hiển thị form tạo và cập nhập danh mục
     * 
     *  @param type = 'products|blogs'
     *  @param categories 
     * */
    function createUpdate($type, Categories $categories, CategoriesRequest $request)
    {
        $categoriesList = $this->categoriesModel->where('type', '=', $type)->whereNull('parent_id');
        if ($categories) {
            $categoriesList->where('id', '!=',  $categories->id);
        }
        return view('pages.admin.Categories.create-update', ['category' => $categories, 'categories' => $categoriesList->get(), 'type' => $type]);
    }
    /**
     *  Lưu dữ liệu vao database
     * 
     *  @param categories = Categories
     *  @param categories 
     * */
    function store($type, Categories $categories, CategoriesRequest $request)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('categories');
            }
            $this->categoriesModel->create([...$request->input(), 'thumbnail' => $thumbnail ?? null, 'type' => $type]);
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Tạo Thành Công', 'redirect_url' => route('admin.categories.index', ['type' => $type, 'categories' => $request->query('parent')])]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Tạo thất bại', 'redirect_url' => route('admin.categories.index', ['type' => $type, 'categories' => $request->query('parent')])]);
        }
    }
    /**
     *  Cập nhập dữ liệu vao database
     * 
     *  @param type = products|blogs
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     * */
    function edit($type, $id, CategoriesRequest $request,)
    {
        try {
            $category = Categories::find($id);
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail')->store('categories');
                if (!empty($categories->thumbnail) && Storage::exists($category->thumbnail)) {
                    Storage::delete($category->thumbnail);
                }
            }
            $category->update([...$request->input(), 'thumbnail' => $thumbnail ?? null, 'type' => $type]);
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Tạo Thành Công', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? ''])]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Tạo thất bại', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? ''])]);
        }
    }
    /**
     *  Xóa nhiều danh mục 
     * 
     *  @param type = products|blogs
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  => sâu khi sóa sẽ gội observer deleted CategoriesObserver::class
     * */
    function deleteMultiple($type, CategoriesRequest $request)
    {
        try {
            $countDelete = 0;
            throw_if(empty($request->categories), 'Bạn phải chọn danh mục');
            Categories::whereIn('id', $request->categories)->each(function ($category) use (&$countDelete) {
                $isDelete = $category->delete();
                if ($isDelete) $countDelete++;
            });
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Xóa thành công ' . $countDelete . ' danh mục', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? '123'])]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Tạo thất bại ', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? '123'])]);
        }
    }
    /**
     *  Xóa  danh mục 
     * 
     *  @param type = products|blogs
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  => sâu khi sóa sẽ gội observer deleted CategoriesObserver::class
     * */
    function destroy($type, Categories $categories)
    {
        try {
            $categories->delete();
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Tạo Thành Công', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? '123'])]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Tạo thất bại', 'redirect_url' => route('admin.categories.index', ['type' => $type ?? '123'])]);
        }
    }
    /**
     *  cập nhập trạng thái danh mục 
     * 
     *  @param type = products|blogs
     *  @param status = hide|display => 0 | 1
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  
     * */
    function status($type, $status, Categories $categories)
    {
        try {
            $categories->update(['display' => ($status == 'hide' ? 0 : 1)]);
            return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn Thành Công danh mục : ' : 'Hiển thị Công danh mục : ') . $categories->name, 'type' => 'success']);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn danh mục thất bại : ' : 'Hiển danh mục thất bại : '), 'type' => 'error']);
        }
    }
    /**
     *  cập nhập nhiều trạng thái danh mục 
     * 
     *  @param type = products|blogs
     *  @param status = hide|display => 0 | 1
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  
     * */
    function statusMultiple($type, $status, CategoriesRequest $request)
    {
        try {
            throw_if(empty($request->input('categories')), 'Không tìm thấy danh mục');
            $categories = $this->categoriesModel->whereIn('id', $request->input('categories'));
            $categories->update(['display' => $status]);
            return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn Thành Công' . $categories->count() . ' danh mục' : 'Hiển thị Công danh mục : '), 'type' => 'success']);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => $e->getMessage(), 'type' => 'error']);
        }
    }
}
