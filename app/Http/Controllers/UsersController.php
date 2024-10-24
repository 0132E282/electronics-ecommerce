<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class UsersController extends Controller
{
    protected $userModel;
    function __construct()
    {
        $this->userModel = new User();
    }
    function index(Request $request)
    {
        $filter = [
            'sort' => $request->sort,
            'direction' => $request->direction,
            'search' => $request->search,
            'date' => $request->date ?? null,
        ];
        $users = $this->userModel->whereNot('id', Auth::id())->filter(...$filter)->paginate(10);
        return view('pages.admin.users.index', ['users' => $users]);
    }
    function createUpdate(User $user)
    {
        return view('pages.admin.users.create-update', ['user' => $user]);
    }
    function store(UserRequest $request)
    {
        try {
            if ($request->hasFile('photo_url')) {
                $photo_url = $request->file('photo_url')->store('users');
            }
            $this->userModel->create([
                'photo_url' => $photo_url ?? null,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->redirectTo(route('site.alert', [Route::current()->uri(), 'type' => 'success']))
                ->with('message', ['content' => 'Tạo Thành Công', 'redirect_url' => route('admin.users.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(route('site.alert', [Route::current()->uri(), 'type' => 'error']))
                ->with('message', ['content' => 'Tạo thất bại', 'redirect_url' => route('admin.users.index')]);
        }
    }
    function edit(User $user, UserRequest $request)
    {
        try {
            if ($request->hasFile('photo_url')) {
                $photo_url = $request->file('photo_url')->store('users');
                if (Storage::exists($user->photo_url)) {
                    Storage::delete($user->photo_url);
                }
            }
            $user->update([
                'photo_url' => $photo_url  ??  $user->photo_url,
                'name' => $request->name  ??  $user->name,
                'email' => $request->email ??  $user->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
            ]);
            return response()->redirectTo(Route::current()->uri() . '/alert?type=success')
                ->with('message', ['content' => 'cập nhập người dùng thành công', 'redirect_url' => route('admin.users.index')]);
        } catch (Exception $e) {
            return response()->redirectTo(Route::current()->uri() . '/alert?type=error')
                ->with('message', ['content' => 'Xóa thất bại', 'redirect_url' => route('admin.users.index')]);
        }
    }
    function destroy(User $user)
    {
        try {
            $user->delete();
            return Redirect::back()->with('message', ['content' => 'Xóa thành công người dùng ' . $user->name, 'type' => 'success']);
        } catch (Exception $e) {
            return  Redirect::back()->with('message', ['content' => 'Xóa người dùng thất bại ', 'type' => 'error']);
        }
    }
    function deleteMultiple(Request $request)
    {
        try {
            if (empty($request->user)) throw new Exception('Không tìm thấy người dùng');
            $this->userModel->whereIn('id', $request->input('user'))->each(function ($user) {
                $user->delete();
            });
            return Redirect::back()->with('message', ['content' => 'Xóa thành công người dùng ', 'type' => 'success']);
        } catch (Exception $e) {
            return  Redirect::back()->with('message', ['content' => $e->getMessage(), 'type' => 'error']);
        }
    }
    function locked($type, User $user)
    {
        try {
            $user->update(['locked_at' => $type == 'locked' ? Date::now() : null]);
            return Redirect::back()->with('message', ['content' => ($type == 'locked' ? 'Đã Khóa tài khoản : ' : 'Bạn đã mỡ khóa tài khoản : ') . $user->name, 'type' => 'success']);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => 'Khóa tài khoản Thất bài', 'type' => 'error']);
        }
    }
    function lockedMultiple($type, Request $request)
    {
        try {
            if (empty($request->user)) throw new Exception('Không tìm thấy người dùng');
            $this->userModel->whereIn('id', $request->input('user'))->update(['locked_at' => $type == 'locked' ? Date::now() : null]);
            return Redirect::back()->with('message', ['content' => ($type == 'locked' ? 'Đã Khóa tài khoản : ' : 'Bạn đã mỡ khóa tài khoản : '), 'type' => 'success']);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => $e->getMessage(), 'type' => 'error']);
        }
    }
    function profile(User $user)
    {
        try {
            return view('pages.admin.users.profile', ['user' => $user->id ?   $user : Auth::user()]);
        } catch (Exception $e) {
            return Redirect::back()->with('message', ['content' => 'Khóa tài khoản Thất bài', 'type' => 'error']);
        }
    }
}
