<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ログインチェックNGの場合はトップにリダイレクト
        if(\Auth::check() == false){
            $message="ログインされていないと判断されました";
            $redirect="トップページ";
            $url="/";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);            
        }
        
        //タスク登録フォームを表示するbladeに飛ばす
        return view('tasks/create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//バリデーション
       $this->validate($request, [
            'title' => 'required|max:191',
            'type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'task_time_hours' => 'required|digits_between:1,100',
            'task_time_mins' => 'required|digits_between:0,360',
            'zone' => 'required|digits_between:1,7',
            ]);
        
        //ユーザーチェック
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
        
        //合成する
        $hours=$request->task_time_hours;
        $mins=$request -> task_time_mins;
        $task_time=$hours*60 + $mins;


        //新規登録する
        $request->user()->tasks()->create([
            'user_id' => $id,
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'task_time' => $task_time,
            'zone' => $request->zone,
            'memo' => $request->memo,
        ]);

        //処理完了ページにメッセージとともに飛ばす
        $message="タスク登録されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);

    }

    /**
     * 今後のタスク一覧を出す
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function future()
    {
        //ログイン認証で自分のidを取得
        $id=\Auth::id();
        $user=User::find($id);

        $today=date('Y-m-d');
  
        //Tasksテーブルのuser_idから自分のタスクを取得
       $tasks=$user -> tasks() ->where('user_id',$id)->where('start_date','>',$today)->where('status','unfinished')->orderby('start_date')->orderby('zone')->get();

        
        //$tasksとしてbladeに渡す
        return view('tasks/future',['tasks' => $tasks]);
        
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //そのidからtaskデータを取得
        $task=Task::find($id);
        
        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }        
    

        //分数を時間と分数に分解
        $sum=$task -> task_time;
        $mins=fmod($sum,60);
        $hours=floor($sum/60);
        
        
        //編集フォームおよび削除ボタンのあるbladeに渡す
        return view('tasks/edit',['task'=> $task,'hours'=>$hours,'mins'=>$mins ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//バリデーション
       $this->validate($request, [
            'title' => 'required|max:191',
            'type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'task_time_hours' => 'required|digits_between:1,100',
            'task_time_mins' => 'required|digits_between:0,360',
            'zone' => 'required|digits_between:1,7',
            ]);

        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        $task=\App\Task::find($request -> task_id);
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }    
        
            
        //合成する
        $hours=$request->task_time_hours;
        $mins=$request -> task_time_mins;
        $task_time=$hours*60 + $mins;
        
        
        //更新処理
                //新規登録する
        $request->user()->tasks()->where('id',$request -> task_id)->update([
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'task_time' => $task_time,
            'zone' => $request->zone,
            'memo' => $request->memo,
        ]);
        

        //処理完了ページにメッセージとともに飛ばす
        $message="タスク更新されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        
            
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        $task=\App\Task::find($request -> task_id);
        

        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }    
                
        
       //リピートのタスクは翌日に新規登録する
       if($task -> type == 'repeat' && $request -> repeat_del == null){
           
        $tomorrow=date('Y-m-d', strtotime('+1 day'));   
           
        //新規登録する
        $request->user()->tasks()->create([
            'user_id' => $id,
            'title' => $task->title,
            'type' => $task->type,
            'start_date' => $tomorrow,
            'task_time' => $task ->task_time,
            'zone' => $task->zone,
            'task_order' => $task->task_order,
            'memo' => $task->memo,
        ]);           
           
           
       }
       
        
        //タスクを削除する
        $task -> delete();
        
        
        //処理完了ページにメッセージとともに飛ばす
        $message="タスクが削除されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        return view('commons/completed',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        
    }
}
