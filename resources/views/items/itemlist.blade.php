@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示 -->
@include('common.errors')

<!-- 検索 -->
<form action="{{ route('itemlist') }}" method="GET" class="d-flex p-2">
    {{ csrf_field() }}
    
    <div class="col-auto">
        <input type="search" name="keyword" class="form-control me-2" aria-label="Search">
    </div>
    <div class="col-auto">
        <div class="ms-2"></div>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">
            {{ __('検索') }}
        </button>
    </div>
    <div class="col-auto ms-auto">
        <a href="{{ route('item/create') }}" class="btn btn-secondary">
            {{ __('商品登録') }}
        </a>
    </div>
</form>

<!-- 商品一覧 -->
<table class="table">
    <thead>
        <tr>
            <th>ＩＤ</th>
            <th>名前</th>
            <th>種別</th>
            <th>詳細</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td><a href="/detail/{{ $item->id }}">{{ $item->id }}</a></td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type_name }}</td>
            <td>{{ $item->detail }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection