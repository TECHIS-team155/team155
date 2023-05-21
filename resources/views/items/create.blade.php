@extends('layouts.app')

@section('content')

<!-- バリデーションエラーの表示 -->
@include('common.errors')

<!-- 新アイテムフォーム -->
<div class="container">
    <form action="{{ url('item') }}" method="POST">
    {{ csrf_field() }}
        <div>名前</div>
        <div>
            <input class="form-control" type="text" name="name" id="item-name" maxlength="100">
        </div>
        <br>
        <div>種別</div>
        <div>
            <select id="typeSelect" name="type" class="form-control">
                <option value="">選択してください</option>
                @foreach ($types as $id => $type)
                    <option value="{{ $id }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>詳細</div>
        <div>
            <input class="form-control" type="text" name="detail" id="item-detail" maxlength="500">
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-secondary">登録</button>
        </div>
    </form>
</div>

@endsection