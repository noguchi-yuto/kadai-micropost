@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{--タブ--}}
            @include('users.navtabs')
            <div class="mt-4">
                {{--ユーザ一覧--}}
                @include('users.users')
            </div>
        </aside>
    </div>
@endsection