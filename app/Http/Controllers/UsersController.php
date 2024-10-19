<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    function index()
    {
        return view('pages.admin.users.index');
    }
}
