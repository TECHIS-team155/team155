@extends('layouts.app')

@section('content')
    <form action="/update" method="post">
    <input type="number" class="form-control mb-3" name="id" value="{{$item->id}}" hidden>
        @csrf
    名前
        <input type="text" class="form-control mb-3" name="name" value="{{$item->name}}">

    種別
    <select id="typeSelect" name="type" class="form-control mb-3">
        <option value="">選択してください</option>
        @foreach ($types as $key => $type)
            <option value="{{ $key }}" @if ($item->type == $key) selected @endif >{{ $type }}</option>
        @endforeach
    </select>

    詳細
        <input type="text" class="form-control mb-3" name="detail" value="{{$item->detail}}">

    購入個数
            <input type="text" class="form-control mb-3" name="zaiko" value="{{$item->zaiko}}">
            <button type="submit" class="btn btn-outline-secondary mt-2 px-5">登録</button>
    </form>

@endsection
