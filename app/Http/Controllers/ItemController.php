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

        return redirect('/items');
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
