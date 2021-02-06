<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\site;
use App\Site_site_category;

class SiteController extends Controller
{

    //list画面のアクション
    function list(Request $request)
    {
        //ソートリンクを踏んだ場合の分岐
        if (isset($request->column) && isset($request->sort)) {
            $items = Site::orderByRaw($request->column . ' IS NULL ASC')->orderBy($request->column, $request->sort)->get();
        } else {
            $items = Site::all();
        }
        $userNme = $request->session()->get('name');

        return view('list', ['items' => $items, 'userName' => $userNme]);
    }

    //edit画面へのアクション
    function edit(Request $request)
    {
        $item = '';

        $siteCategoryList = DB::select('select * from site_category');
        $userNme = $request->session()->get('name');
        return view('edit', ['userName' => $userNme, 'site_category_list' => $siteCategoryList, 'item' => $item]);
    }

    //confから戻っってきた時のアクション
    function editPos(Request $request)
    {
        $siteCategoryList = DB::select('select * from site_category');
        $userName = $request->session()->get('name');

        //confの修正ボタンが押され、confからの遷移かの分岐
        if (isset($request->return)) {
            $item = [
                'name' => $request->name,
                'url' => $request->url,
                'img' => $request->img,
                'description' => $request->description,
                'turn' => $request->turn,
                'site_category_num' => $request->site_category_num,
                'record_id' => $request->id
            ];
        } else {
            $dbRecord = Site::find($request->id);
            $siteCategoryIds = Site_site_category::where('site_id', $request->id)->get();

            foreach ($siteCategoryIds as $value) {
                $siteCategoryNum[] = $value->site_category_id;
            }

            $item = [
                'name' => $dbRecord->name,
                'url' => $dbRecord->url,
                'description' => $dbRecord->description,
                'turn' => $dbRecord->turn,
                'img' => $dbRecord->img,
                'site_category_num' => $siteCategoryNum,
                'record_id' => $dbRecord->id
            ];
        }

        return view('edit', ['item' => $item, 'site_category_list' => $siteCategoryList, 'userName' => $userName]);
    }

    //conf画面のアクション
    function conf(Request $request)
    {
        //ここの戻り値は多次元配列1次元目が只の配列、2次元目の要素はインスタンス
        $site_category_list = DB::select('select * from site_category');

        //サイトのカテゴリーを選択した分だけ表示するために
        //まずsite_categoryテーブルからvalueで送られてきた値を元に
        //site_categoryのnameのを取得し選択したカテゴリー名の配列を作成
        foreach ($request->site_category as $value) {
            if (isset($value)) {
                $siteCategoryNameList[] = $site_category_list[$value - 1]->name;
            }
        }

        $userNme = $request->session()->get('name');

        $item = [
            'siteCategoryNameList' => isset($siteCategoryNameList) ? $siteCategoryNameList : '',
            'name' => $request->name,
            'url' => $request->url,
            'img' => $request->img,
            'description' => $request->description,
            'turn' => $request->turn,
            'siteCategoryIdList' => $request->site_category,
            'record_id' => isset($request->id) ? $request->id : null
        ];
        return view('conf', ['item' => $item, 'userName' => $userNme]);
    }

    //登録する際のアクション
    function done(Request $request)
    {
        $userNme = $request->session()->get('name');

        //idがあったら編集
        if (isset($request->id)) {
            $site = Site::find($request->id);
            $bindValues = $request->all();

            DB::transaction(function() use ($bindValues, $site) {
                unset($bindValues['token']);
                $site->fill($bindValues)->save();

                Site_site_category::where('site_id', $site->id)->delete();
                $siteId = $site->id;

                foreach ($bindValues['site_category_num'] as $value) {
                    if (isset($value)) {
                        $site_site_category = new Site_site_category();
                        $site_site_category->site_id = $siteId;
                        $site_site_category->site_category_id = $value;
                        $site_site_category->update();
                    }
                }
            });

        } else {
            $site = new Site();
            $bindValues = $request->all();

            DB::transaction(function() use ($bindValues, $site) {
                unset($bindValues['token']);
                $site->delete_flg = false;
                $site->fill($bindValues)->save();

                $lastInsertId = DB::getPdo()->lastInsertId();
                foreach ($bindValues['site_category_num'] as $value) {
                    if (isset($value)) {
                        $site_site_category = new Site_site_category();
                        $site_site_category->site_id = $lastInsertId;
                        $site_site_category->site_category_id = $value;
                        $site_site_category->save();
                    }
                }
            });
        }

        return view('done', ['userName' => $userNme]);
    }

    //delete空のアクション
    function delete(Request $request)
    {
        Site::find($request->id)->delete();
        Site_site_category::where('site_id', $request->id)->delete();

        return redirect('/list');
    }

    function join()
    {
        $id = 3;
        $site = Site::find(15);
        $test1 =  DB::table('sites')->join('site_site_categorys', 'sites.id', '=', 'site_site_categorys.site_id')->get();
        $test =  DB::table('sites')->join('site_site_categorys', 'sites.id', '=', 'site_site_categorys.site_id')->where('site_site_categorys.site_category_id', $id)->get();
        dd($test);
    }
}
