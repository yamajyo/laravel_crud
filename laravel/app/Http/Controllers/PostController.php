<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\PostCategory;

class PostController extends Controller
{
    function index(Request $request)
    {
        //ソート機能をカテゴリー選択した後でも機能させるため、カテゴリーを選択した場合のクエリを取得
        if(isset($request->postId))
        {
            $postId = $request->postId;
        } else {
            $postId = '';
        }

        // ソートリンクを踏んだ場合、またカテゴリー選択の分岐
        if (isset($request->column) && isset($request->sort) && !empty($postId)) {
            $items =  DB::table('posts')->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->where('post_categories.category_id', $postId)->orderByRaw($request->column . ' IS NULL ASC')->orderBy($request->column, $request->sort)->get();
        } else if (isset($request->column) && isset($request->sort)) {
            $items = Post::orderByRaw($request->column . ' IS NULL ASC')->orderBy($request->column, $request->sort)->get();
        } else if (!empty($postId)){
            $items =  DB::table('posts')->join('post_categories', 'posts.id', '=', 'post_categories.post_id')
            ->where('post_categories.category_id', $postId)->get();
        } else {
            $items = Post::all();
        }

        $categoryList = Category::all();

        return view('bbs.index', ['items' => $items, 'categoryList' => $categoryList, 'postId' => $postId]);
    }

    //edit画面へのアクション（新規登録の際のgetリクエスト時のアクション）
    function edit(Request $request)
    {
        $item = '';

        $categoryList = Category::all();
        return view('bbs.edit', ['categoryList' => $categoryList, 'item' => $item]);
    }

    //confから戻っってきた時、または編集リンクを踏んだ際ののアクション
    function editPos(Request $request)
    {
        $categoryList = Category::all();

        //confの修正ボタンが押され、confからの遷移かの分岐
        if (isset($request->return)) {
            $item = [
                'title' => $request->title,
                'description' => $request->description,
                //セレクトボックスで選択済みにさせるためのCategoryナンバー
                'category_num' => $request->category_num,
                //編集か新規登録かの分岐を行うためのpostテーブルのid
                'record_id' => $request->id
            ];
        } else {
            $dbRecord = Post::find($request->id);
            $postCategoryIds = PostCategory::where('post_id', $request->id)->get();

            foreach ($postCategoryIds as $value) {
                $categoryNum[] = $value->category_id;
            }

            $item = [
                'title' => $dbRecord->title,
                'description' => $dbRecord->description,
                //セレクトボックスで選択済みにさせるためのCategoryナンバー
                'category_num' => $categoryNum,
                //編集か新規登録かの分岐を行うためのpostテーブルのid
                'record_id' => $dbRecord->id
            ];
        }

        return view('bbs.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    //conf画面のアクション
    function conf(Request $request)
    {

        $categoryList = Category::all();

        //カテゴリーを選択した分だけカテゴリー名を表示するために
        //postされたcategory配列の値を元に
        //Categoryのcategory_nameのを取得し選択したカテゴリー名の配列を作成
        foreach ($request->category as $value) {
            if (isset($value)) {
                $categoryNameList[] = $categoryList[$value - 1]->category_name;
            }
        }

        $item = [
            //カテゴリー名の配列
            'categoryNameList' => isset($categoryNameList) ? $categoryNameList : '',
            'title' => $request->title,
            'description' => $request->description,
            //DB登録で使用する際のCategoryの数値
            'categoryIdList' => $request->category,
            //編集か新規登録かの分岐を行うためのpostテーブルのid
            'record_id' => isset($request->id) ? $request->id : null
        ];
        return view('bbs.conf', ['item' => $item]);
    }

    //登録する際のアクション
    function done(Request $request)
    {
        //idがあったら編集
        if (isset($request->id)) {
            $post = Post::find($request->id);
            $bindValues = $request->all();

            DB::transaction(function() use ($bindValues, $post) {
                $post->title = $bindValues['title'];
                $post->description = $bindValues['description'];
                $post->save();

                PostCategory::where('post_id', $post->id)->delete();
                $postId = $post->id;

                foreach ($bindValues['category_num'] as $value) {
                    if (isset($value)) {
                        $postCategory = new PostCategory();
                        $postCategory->post_id = $postId;
                        $postCategory->category_id = $value;
                        $postCategory->save();
                    }
                }
            });

        } else {
            $bindValues = $request->all();

            DB::transaction(function() use ($bindValues) {
                $post = new Post();
                $post->title = $bindValues['title'];
                $post->description = $bindValues['description'];
                $post->save();

                $lastInsertId = DB::getPdo()->lastInsertId();
                foreach ($bindValues['category_num'] as $value) {
                    if (isset($value)) {
                        $postCategory = new PostCategory();
                        $postCategory->post_id = $lastInsertId;
                        $postCategory->category_id = $value;
                        $postCategory->save();
                    }
                }
            });
        }

        return view('bbs.done');
    }

    //delete空のアクション
    function delete(Request $request)
    {
        Post::find($request->id)->delete();
        PostCategory::where('post_id', $request->id)->delete();

        return redirect('/');
    }

}
