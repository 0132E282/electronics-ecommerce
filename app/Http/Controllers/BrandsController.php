<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brands;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    protected $brandsModel;
    function __construct()
    {
        $this->brandsModel = new Brands();
    }
    function index(Request $request)
    {
        $filter = [
            'search' => $request->search,
            'date' => $request->created,
        ];
        $brands = $this->brandsModel->filter($filter)->sort($request->sort, $request->direction)->paginate(10);
        return view('pages.admin.Brands.index', ['brands' =>   $brands]);
    }
    function createUpdate(Brands $brands)
    {

        return view('pages.admin.Brands.create-update', ['brand' => $brands ?? null]);
    }
    function store(BrandRequest $request)
    {
        try {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('brands');
            }
            $brand = $this->brandsModel->create([...$request->input(), 'logo' => $logo ?? null]);
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Tạo thành công thương hiệu ' . $brand->name, 'redirect_url' => route('admin.brands.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => $e->getMessage(), 'redirect_url' => route('admin.brands.index')]);
        }
    }
    function edit($id, BrandRequest $request)
    {
        try {
            $brand = $this->brandsModel->find($id);
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('brands');
                if (!empty($brand->logo) && Storage::exists($brand->logo)) {
                    Storage::delete($brand->logo);
                }
            }
            $brand->update([...$request->input(), 'logo' => $logo ?? null]);
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Cập nhập thương hiệu ' .  $brand->name, 'redirect_url' => route('admin.brands.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => $e->getMessage(), 'redirect_url' => route('admin.brands.index')]);
        }
    }
    function destroy(Brands $brands)
    {
        try {
            $brands->delete();
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Đã xóa thương hiệu ' . $brands->name, 'redirect_url' => route('admin.brands.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Xóa thương hiệu ' . $brands->name . ' thất bại', 'redirect_url' => route('admin.brands.index')]);
        }
    }

    /**
     *  cập nhập trạng thái thương hiệu 
     * 
     *  @param type = products|blogs
     *  @param status = hide|display => 0 | 1
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  
     * */
    // function status($type, $status, Categories $categories)
    // {
    //     try {
    //         $categories->update(['display' => ($status == 'hide' ? 0 : 1)]);
    //         return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn Thành Công thương hiệu : ' : 'Hiển thị Công thương hiệu : ') . $categories->name, 'type' => 'success']);
    //     } catch (Exception $e) {
    //         return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn thương hiệu thất bại : ' : 'Hiển thương hiệu thất bại : '), 'type' => 'error']);
    //     }
    // }
    /**
     *  cập nhập nhiều trạng thái thương hiệu 
     * 
     *  @param type = products|blogs
     *  @param status = hide|display => 0 | 1
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  
     * */
    function deleteMultiple(BrandRequest $request)
    {
        try {
            $countDelete = 0;
            throw_if(empty($request->brands), 'Không tìm thấy thương hiệu');
            $this->brandsModel->whereIn('id', $request->brands)->each(function ($category) use (&$countDelete) {
                $isDelete = $category->delete();
                if ($isDelete) ++$countDelete;
            });
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'Xóa thành công ' . $countDelete . ' thương hiệu', 'redirect_url' => route('admin.brands.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => $e->getMessage(), 'redirect_url' => route('admin.brands.index')]);
        }
    }
    /**
     *  cập nhập trạng thái thương hiệu 
     * 
     *  @param type = products|blogs
     *  @param status = hide|display => 0 | 1
     *  @param categories = Categories
     *  @param request = CategoriesRequest
     * 
     *  
     * */
    function status($status, Brands $brands)
    {
        try {
            $brands->update(['display' => ($status == 'hide' ? 0 : 1)]);
            return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn Thành Công thương hiệu : ' : 'Hiển thị Công thương hiệu : ') . $brands->name, 'type' => 'success']);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => ($status == 'hide' ? 'Ẩn thương hiệu thất bại : ' : 'Hiển thương hiệu thất bại : '), 'type' => 'error']);
        }
    }
}
