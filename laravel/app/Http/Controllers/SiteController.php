<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\site;
use App\Site_site_category;

class SiteController extends Controller
{
    function test()
    {
        $data = Site::all();
        dd($data);
    }

    function list(Request $request)
    {
        $userNme = $request->session()->get('name');
        $items = Site::all();
        //これを使うとvar_dumpして処理がとまる
        return view('list', ['items' => $items, 'userName' => $userNme]);
    }

    function edit(Request $request)
    {
        if (isset($request->id)) {
            $dbRecord = Site::find($request->id);
            $test = Site_site_category::where('site_id', $request->id)->get();

            $site_category_num = [];

            foreach ($test as $key => $value) {
                $site_category_num[] = $value->site_category_id;
            }
            dd($site_category_num);

            $p = [
                'name' => $dbRecord->name,
                'url' => $dbRecord->url,
                'description' => $dbRecord->description,
                'turn' => $dbRecord->turn,
                'img' => $dbRecord->img,
                'site_category_num' => $site_category_num
            ];
        } else {
            $p = '';
        }

        $site_category_list = DB::select('select * from site_category');
        $userNme = $request->session()->get('name');
        return view('edit', ['userName' => $userNme, 'site_category_list' => $site_category_list, 'item' => $p]);
    }

    function editPos(Request $request)
    {
        $site_category_list = DB::select('select * from site_category');

        $userNme = $request->session()->get('name');
        $p = [
            'name' => $request->name,
            'url' => $request->url,
            'img' => $request->img,
            'description' => $request->description,
            'turn' => $request->turn,
            'site_category_num' => $request->site_category_num
        ];

        return view('edit', ['item' => $p, 'site_category_list' => $site_category_list, 'userName' => $userNme]);
    }

    function conf(Request $request)
    {
        $site_category_list = DB::select('select * from site_category');
        foreach ($request->site_category as $value) {
            if (isset($value)) {
                $site_array[] = $site_category_list[$value - 1]->id;
            }
        }

        if (isset($site_array)) {
            foreach ($site_array as $value) {
                $site_array2[] = $site_category_list[$value - 1]->name;
            }
        }

        $userNme = $request->session()->get('name');

        $p = [
            'site' => isset($site_array2) ? $site_array2 : '',
            'name' => $request->name,
            'url' => $request->url,
            'img' => $request->img,
            'description' => $request->description,
            'turn' => $request->turn,
            's' => $request->site_category
        ];
        return view('conf', ['item' => $p, 'userName' => $userNme]);
    }

    function done(Request $request)
    {
        $userNme = $request->session()->get('name');

        $site = new Site();
        $pp = $request->all();

        DB::transaction(function() use ($pp, $site) {
            unset($pp['token']);
            $site->delete_flg = false;
            $site->fill($pp)->save();

            $lastInsertId = DB::getPdo()->lastInsertId();
            foreach ($pp['site_category_num'] as $value) {
                if (isset($value)) {
                    $site_site_category = new Site_site_category();
                    $site_site_category->site_id = $lastInsertId;
                    $site_site_category->site_category_id = $value;
                    $site_site_category->save();
                }
            }
        });

        return view('done', ['userName' => $userNme]);
    }
}
