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
        
        if($request -> fix_start != null){
            $fix_start=($request -> fix_start).':00';
        }else{
            $fix_start=null;
        }
        

        //新規登録する
        //task_orderは一番下にした
        $request->user()->tasks()->create([
            'user_id' => $id,
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'task_time' => $task_time,
            'zone' => $request->zone,
            'task_order' => '999',
            'memo' => $request->memo,
            'fix_start' => $fix_start,
        ]);

        //処理完了ページにメッセージとともに飛ばす
        $message="タスク登録されました";
        $redirect="新規タスク追加ページ";
        $url="/tasks/create";
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
       $tasks=$user -> tasks() ->where('user_id',$id)->where('start_date','>',$today)->where('status','unfinished')->orderby('start_date')->orderby('title')->get();

        
        //$tasksとしてbladeに渡す
        return view('tasks/future',['tasks' => $tasks]);
        
        
    }
    
    /**
     * 全タスク一覧を出す
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        //ログイン認証で自分のidを取得
        $id=\Auth::id();
        $user=User::find($id);

        //Tasksテーブルのuser_idから自分のタスクを取得
       $tasks=$user -> tasks() ->where('user_id',$id)->where('status','unfinished')->orderby('start_date')->orderby('title')->get();

        
        //$tasksとしてbladeに渡す
        return view('tasks/all',['tasks' => $tasks]);
        
        
    }    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function mytime_get($print=null)
    {
        //ユーザー認証して、そのユーザーのタスクを取得
            $id=\Auth::id();
            $user=User::find($id);
        //その人のスタート時間も取得
        $start_time=$user -> start_time;

        //現在時間から10分後
        $timestamp = strtotime( "+10 minutes" );
        $now = date("H:i:s",$timestamp);

        //比較して後の方を有効とする
        if(strtotime($start_time) < strtotime($now)){
            $start_time = $now;
        }

        //秒数部分を省く
        $start_time=substr($start_time, 0, 5);


            $today=date('Y-m-d');    

        //表示用の抽出、ソート
        //本日以前のタスクで、未完了のもの、task_order順、zone順
           $tasks=$user -> tasks() ->whereDate('start_date','<=',$today)->where('status','unfinished')->orderby('task_order')->orderby('zone')->orderby('start_date')->get();


        //これを配列$tasksとしてviewに渡す


        return view('tasks/mytime',['tasks' => $tasks,'start_time' => $start_time,'print' => $print]);

    }

    public function mytime_post(Request $request)
    {
//チェック用
/*
echo $request -> result;
echo $request -> hour;
exit;
*/
        //ユーザー認証して、そのユーザーのタスクを取得
            $id=\Auth::id();
            $user=User::find($id);

        //その人のスタート時間も取得してあるもので作成
            $start_time=$request -> hour.":".$request -> min;

        //順序をテーブルに書き換える
        $orders=explode(',', $request -> result);
        //タスクがなくボタンを押されたら例外処理
        if(count($orders)==0){
            "WOOPS!";
            exit;
        }    

        $new_order=1;
        foreach($orders as $order){
            $array=explode("-",$order);
            $task_id=$array[0];

            //$task_idのタスクをtask_orderの値を$new_orderで書き換えする
            $request->user()->tasks()->where('id',$task_id)->update([
                'task_order' => $new_order,
            ]);

            ++$new_order;

        }

        $today=date('Y-m-d');    

        //表示用の抽出、ソート
        //本日以前のタスクで、未完了のもの、task_order順、zone順
           $tasks=$user -> tasks() ->whereDate('start_date','<=',$today)->where('status','unfinished')->orderby('task_order')->orderby('zone')->orderby('start_date')->get();


        //これを配列$tasksとしてviewに渡す
        return view('tasks/mytime',['tasks' => $tasks,'start_time' => $start_time,'print' => null]);
    
    }


/*

マイタイムトモロー
*/



    public function mytime_tm_get($print=null)
    {
        //ユーザー認証して、そのユーザーのタスクを取得
            $id=\Auth::id();
            $user=User::find($id);
        //その人のスタート時間も取得
        $start_time=$user -> start_time;

        //現在時間から10分後
        $timestamp = strtotime( "+10 minutes" );
        $now = date("H:i:s",$timestamp);

        //比較して後の方を有効とする
        if(strtotime($start_time) < strtotime($now)){
            $start_time = $now;
        }

        //秒数部分を省く
        $start_time=substr($start_time, 0, 5);

            //明日の日付
            $tm=date('Y-m-d', strtotime('+1 day'));    

        //表示用の抽出、ソート
        //明日のタスクで、未完了のもの、task_order順、zone順
           $tasks=$user -> tasks() ->whereDate('start_date','=',$tm)->where('status','unfinished')->orderby('task_order')->orderby('zone')->orderby('start_date')->get();


        //これを配列$tasksとしてviewに渡す


        return view('tasks/mytime',['tasks' => $tasks,'start_time' => $start_time,'print' => $print]);

    }

    public function mytime_tm_post(Request $request)
    {
//チェック用
/*
echo $request -> result;
echo $request -> hour;
exit;
*/
        //ユーザー認証して、そのユーザーのタスクを取得
            $id=\Auth::id();
            $user=User::find($id);

        //その人のスタート時間も取得してあるもので作成
            $start_time=$request -> hour.":".$request -> min;

        //順序をテーブルに書き換える
        $orders=explode(',', $request -> result);
        //タスクがなくボタンを押されたら例外処理
        if(count($orders)==0){
            "WOOPS!";
            exit;
        }    

        $new_order=1;
        foreach($orders as $order){
            $array=explode("-",$order);
            $task_id=$array[0];

            //$task_idのタスクをtask_orderの値を$new_orderで書き換えする
            $request->user()->tasks()->where('id',$task_id)->update([
                'task_order' => $new_order,
            ]);

            ++$new_order;

        }

            //明日の日付
            $tm=date('Y-m-d', strtotime('+1 day'));    
   

        //表示用の抽出、ソート
        //本日以前のタスクで、未完了のもの、task_order順、zone順
           $tasks=$user -> tasks() ->whereDate('start_date','=',$tm)->where('status','unfinished')->orderby('task_order')->orderby('zone')->orderby('start_date')->get();


        //これを配列$tasksとしてviewに渡す
        return view('tasks/mytime',['tasks' => $tasks,'start_time' => $start_time,'print' => null]);
    
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
        
        if($task == null){
            echo "そのタスクはすでに削除されています";
            exit;
        }
        
        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
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
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }    
        
            
        //合成する
        $hours=$request->task_time_hours;
        $mins=$request -> task_time_mins;
        $task_time=$hours*60 + $mins;
        
        if($request -> fix_start != null){
            $fix_start=($request -> fix_start).':00';
        }else{
            $fix_start=null;
        }
        
        
        //更新処理
    
        $request->user()->tasks()->where('id',$request -> task_id)->update([
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'task_time' => $task_time,
            'zone' => $request->zone,
            'memo' => $request->memo,
            'fix_start' => $fix_start,
        ]);
        

        //処理完了ページにメッセージとともに飛ばす
        $message="タスク更新されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        $list_id="list-".$task -> id;
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url,'list_id'=>$list_id]);
        
            
            
    }
    
    
    
    
    
    
    
    /**
     * マイタイムのリストのラベルリンクから開始日だけを簡単にずらす
     */
    public function changedate($task_id,$plus)
    {
        //バリデーション
        /*
        $request = array('task_id'=>$task_id);
        $request = $request + array('plus'=>$plus);
        
       $this->validate($request, [
            'task_id' => 'required|integer|min:1',
            'plus' => 'required|integer|min:1',
            ]);
        */
        
        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        $task=\App\Task::find($task_id);
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }    
        
            
        //合成する　開始日を決める
        $start_date=date("Y-m-d", strtotime("+$plus day"));
        //plus日後\n";


        //更新処理 $taskにすでにこのタスクのみが指定されているので
    
        $task->update([
            'start_date' => $start_date,
        ]);
        

        //処理完了ページにメッセージとともに飛ばす
        $message="タスク更新されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        $list_id="list-".$task -> id;
        return view('commons/completed_mini_nopost',['message' => $message,'redirect' => $redirect,'url'=>$url,'list_id'=>$list_id]);
        
            
            
    }
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function destroy_before($id)
    {
        
        //そのidからtaskデータを取得
        $task=Task::find($id);
        if($task == null){
            $message="すでにそのタスクは削除されています";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }   
        
        //ユーザーチェック
        //ユーザー認証からユーザーidを得る
        $id=\Auth::id();
        
        //一応POSTされた$user_idがそれと同じがチェックする
        //同じでなければ、ログアウトさせてしまう
        if($id != $task->user_id){
            $message="経路エラーのため更新は行われませんでした";
            $redirect="マイタイムページ";
            $url="/mytime";
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }        
    
        
        
        //編集フォームおよび削除ボタンのあるbladeに渡す
        return view('tasks/destroy_before',['task'=> $task]);
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
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url]);
        }    
                
        
       //リピートのタスクは翌日に新規登録する
       if($task -> type == 'repeat' && $request -> repeat_del == null){
           
        $tomorrow=date('Y-m-d', strtotime('+1 day'));
        if($request -> start_date != null){
            $next_time=$request -> start_date;
        }else{
            $next_time=$tomorrow;
        }
           
        //新規登録する
        $request->user()->tasks()->create([
            'user_id' => $id,
            'title' => $task->title,
            'type' => $task->type,
            'start_date' => $next_time,
            'task_time' => $task ->task_time,
            'zone' => $task->zone,
            'task_order' => $task->task_order,
            'memo' => $task->memo,
        ]);           
           
           
       }
       
       //削除する前にviewにどのタスクを削除したかを知らせるために
       $list_id="list-".$task -> id;
        
        //タスクを削除する
        $task -> delete();
        
        
        //処理完了ページにメッセージとともに飛ばす
        $message="タスクが削除されました";
        $redirect="マイタイムページ";
        $url="/mytime";
        
        return view('commons/completed_mini',['message' => $message,'redirect' => $redirect,'url'=>$url,'list_id' => $list_id]);
        
    }
}
