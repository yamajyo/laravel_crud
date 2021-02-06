<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\site;
use App\Site_site_category;

class UserController extends Controller
{
    function index()
    {
        $items = Site::all();
        $siteCategoryList = DB::select('select * from site_category');
        return view('index', ['items' => $items, 'siteCategoryList' => $siteCategoryList]);
    }
}
