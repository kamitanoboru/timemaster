<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;    // 追加


class UsersController extends Controller
{
        public function edit()
    {
        //編集フォームおよび削除ボタンのあるbladeに渡す
        return view('users/edit');
    }

        public function update(Request $request)
    {
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $request->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }
        
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'start_time' => 'required|max:8',
        ]);
        

        //$gcが本当にグーグルカレンダーのタグかチェック
        if(!preg_match('/^<iframe src="https:\/\/calendar.google.com\/calendar\/embed?.+<\/iframe>$/',$request -> gc)){
            $message="googleカレンダーのタグではないようです　文頭、文末に余計な空白や文字が入ってないか確認してください";
            $redirect="マイタイムページ";
            $url="/mytime";
            return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }
        
        //バリデーション
        $gc = htmlspecialchars($request -> gc);   
        $mymemo = htmlspecialchars($request -> mymemo);           
        
        //同じ場合、そのidのユーザー情報をPOSTされたデータで更新する
        //パスワードがnullかどうかで分岐
        //パスワードがnullの場合
        if($request -> password == null){
            $request->user()->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'start_time' => $request->start_time,
                'gc' => $gc,
                'mymemo' => $mymemo,
            ]);
        
        //パスワードがnullでない場合
        }else{
            
            if($request->password != $request->password_confirmation){
            $message="パスワード不一致のため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);                
            }
            
            //start_timeの秒数は削除する
            $start_time = $request->start_time;
            $start_time=date('H:i',strtotime($start_time));
            
            $request->user()->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'start_time' => $start_time,
                'gc' => $gc,
                'mymemo' => $mymemo,
            ]);    
            
        }
        
        //更新処理
        
        
        //処理完了ページにメッセージとともに飛ばす
        $message="ユーザー情報が更新されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
    }    
    
    
    
            public function destroy(Request $request)
    {
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $request->user_id){
            $message="経路エラーのためアカウント削除は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);

 
        }
        
        
        //アカウントを削除する
        \Auth::user()-> delete();
        
        
        //処理完了ページにメッセージとともに飛ばす
        $message="アカウントが削除されました";
        $redirect="トップページ";
        $url="/";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
    }    
    
    /*グーグルカレンダーの表示*/
    
            public function gc()
    {
        //編集フォームおよび削除ボタンのあるbladeに渡す
        return view('users/gc');
    }
    
        /*マイメモの表示*/
    
            public function mymemo()
    {
        //編集フォームおよび削除ボタンのあるbladeに渡す
        return view('users/mymemo');
    }
    
}
