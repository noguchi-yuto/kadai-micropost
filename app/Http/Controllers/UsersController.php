<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        //ユーザー一覧をidの降順で取得
        $users=User::orderBy('id','desc')->paginate(10);
        
        //ユーザー一覧ビューでそれを表示
        return view('users.index',[
            'users'=> $users,
        ]);
    }
    
    public function show($id)
    {
        //idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        //関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザの投稿一覧を作成日時の降順で取得
        $microposts=$user->microposts()->orderBy('created_at','desc')->paginate(10);
        
        //ユーザー詳細ビューでそれを表示
        return view('users.show',[
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    
    public function followings($id){
        //idでユーザを検索
        $user = User::findOrFail($id);
        
        //モデルの件数をロード
        $user->loadRelationshipCounts();
        
        //フォロー一覧を取得
        $followings=$user->followings()->paginate(10);
        
        //フォロー一覧ビューでそれらを表示
        return view('users.followings',[
            'user' => $user,
            'users' =>$followings,
        ]);
    }
    
    public function followers($id){
        //idで検索し取得
        $user = User::findOrFail($id);
        
        //モデルをロード
        $user->loadRelationshipCounts();
        
        //ユーザのフォロワー一覧を取得
        $followers=$user->followers()->paginate(10);
        
        //一覧ビューで表示
        return view('users.followers',[
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function favoritings($id){
        //id検索
        $user=User::findOrFail($id);
        //ロード
        $user->loadRelationshipCounts();
        //一覧取得
        $favoritings=$user->favorites()->paginate(10);
        //ビューで表示
        return view('users.favorites',[
            'user'=>$user,
            'microposts'=>$favoritings,
        ]);
    }
}
