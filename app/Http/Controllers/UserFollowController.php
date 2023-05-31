<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store($id){
        //認証済みユーザ(閲覧者)がidのユーザをフォローする
        \Auth::user()->follow($id);
        //リダイレクト
        return back();
    }
    
    public function destroy($id){
        //認証済みユーザ(閲覧者)がidのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        //リダイレクト
        return back();
    }
}
