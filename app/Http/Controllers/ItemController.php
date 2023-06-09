<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Item;
use App\Models\Type;

class ItemController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function itemlist(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword !== null) {
            $keyword = mb_convert_kana($keyword, 'KV');
        }

        $items = Item::leftJoin('types', 'types.id', '=', 'items.type')
                ->select('items.id', 'items.name', 'types.type_name', 'items.detail');

        if (!empty($keyword)) {
            $items = $items->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%')
                    ->orwhere('type_name', 'LIKE', '%'.$keyword.'%')
                    ->orwhere('detail', 'LIKE', '%'.$keyword.'%');
            });
        }

        $items = $items->get();
        // dd($items);
        return view('items.itemlist', [
            'items' => $items,
        ]);
    }

    public function detail($id)
    {
        $item = Item::find($id);
        // dd($item);
        $types = Type::orderBy('id')->pluck('type_name', 'id');
        return view('items.detail', compact('item','types'));
    }
    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->zaiko = $request->zaiko;
        $item->updated_at = now();
        $item->save();
        return redirect('/home');
    }

    /**
     * アイテム登録
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'nullable|max:500',
        ]);

        // タスク作成
        $request->user()->items()->create([
            'name' => $request->name,
            'type' => $request->type,
            'detail' => $request->detail,
        ]);

        return redirect('/itemlist');
    }

    /**
     * 種別の取得
     * 
     * @return Respons
     */
    public function create()
    {
        $types = Type::orderBy('id')->pluck('type_name', 'id');
        return view('items.create', ['types' => $types]);
    }
}