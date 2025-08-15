@extends('layouts.app') // layoutsフォルダの app.blade.php を継承

@section('title', '個別ページのタイトル') // マスターの @yield('title') に渡す内容

@section('content') // マスターの @yield('content') に渡す内容。@endsection までが範囲
    <h1>個別ページの見出し</h1>
    <p>このページ独自のコンテンツです。</p>
@endsection

{{-- @section('scripts') --}} // 必要であれば、マスターに定義した他のセクションもここで埋める
{{-- <script>alert('個別ページ固有のJS');</script> --}}
{{-- @endsection --}}