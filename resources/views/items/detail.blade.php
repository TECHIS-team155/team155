@extends('layouts.app')

@section('content')
    <form action="/update" method="post">
        @csrf
    名前
        <input type="text" class="form-control" name="name" value="{{$item->name}}">

    種別
    <select id="typeSelect" name="type" class="form-control">
        <option value="">選択してください</option>
        @foreach ($types as $id => $type)
            <option value="{{ $id }}" @if ($item->type == $id) selected @endif >{{ $type }}</option>
        @endforeach
    </select>

    詳細
        <input type="text" class="form-control" name="detail" value="{{$item->detail}}">

    購入個数
            <input type="text" class="form-control" name="zaiko" value="">
            {{-- <input type="text" name="detail" value="{{$item->}}"> --}}
            <button type="submit" class="btn btn-outline-secondary">登録</button>

@endsection
