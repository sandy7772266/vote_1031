<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//require 'vendor/autoload.php';

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//    return Response::make('Not Found', 404);
//});

Route::get('/', ['as' => 'home', 'uses' => 'VoteController@index']);

Route::get('/openid', function()
{
    return View::make('hello');
});

Route::get('login/openid', ['as' => 'login/openid', 'uses' => 'AuthController@openIDLogin']);
Route::get('logout/openid', ['as' => 'logout/openid', 'uses' => 'AuthController@openIDLogout']);
Route::get('user/data/show', 'AuthController@showUserData');


Route::get('/insert-first', array('as' => 'vote.insert-first', function() 
    {
        $votes = Vote::get();
        // return our view and Vote information
        return View::make('tasks.vote-insert-first', compact('votes'));
    }));
Route::get('/insert-second/{id}', array('as' => 'vote.insert-second', function($id) 
    {
        //$votes = Vote::get();
        // return our view and Vote information
        Session::put('vote_id_insert', $id);
        return View::make('tasks.vote-insert-second');
    }));
// Route::get('t', 'CandidateController@create');
// Route::get('t2',  'CandidateController@store_a');

Route::get('excel', ['as' => 'import_cadidates', 'uses' => 'CandidateController@create']);
Route::get('excel_value', ['as' => 'import_cadidates_value', 'uses' => 'CandidateController@create']);
Route::get('store_a', ['as' => 'store_cadidates', 'uses' => 'CandidateController@store_a']);
//Route::get('/passsec/', ['as' => 'passsec', 'uses' => 'VoteController@passsec']);
Route::post('file_import', ['as' => 'file_import', 'uses' => 'CandidateController@file_move']);
Route::get('candidates_index', ['as' => 'cadidates', 'uses' => 'CandidateController@index']);

//Route::get('/', ['as' => 'home']);
Route::get('/{id}', array('as' => 'vote.edit', function($id) 
    {
        // return our view and Vote information
        return View::make('tasks.vote-edit') // pulls app/views/nerd-edit.blade.php
            ->with('vote', Vote::find($id));
    }))->where('id','[0-9]+');


Route::get('/manage', array('as' => 'manage', function() 
    {
        $time_now = Carbon::now();

        $votes = Vote::get();
        //dd($votes);
        $ary[0] = $votes;
        foreach ($ary[0] as $vote){
           // $candidate = Candidate::find($vote->id);
            $candidate_c = Candidate::where('vote_id', '=', $vote->id)->first();
            if ($candidate_c <> null){
                $ary[1][$vote->id] = $candidate_c->vote_id;
            }
            else{
                $ary[1][$vote->id] = '沒有資料';
            }
        }
        // return our view and Vote information
        return View::make('tasks.vote-manage-index',compact('ary','time_now'));
    }));

Route::get('/voting', array('as' => 'voting', function() 
    {
        $time_now = Carbon::now();

        $votes = Vote::get();
        //dd($votes);
        $ary[0] = $votes;
        foreach ($ary[0] as $vote){
           // $candidate = Candidate::find($vote->id);
            $candidate_c = Candidate::where('vote_id', '=', $vote->id)->first();
            if ($candidate_c <> null){
                $ary[1][$vote->id] = $candidate_c->vote_id;
            }
            else{
                $ary[1][$vote->id] = '沒有資料';
            }
        }
        // return our view and Vote information
        return View::make('tasks.voting',compact('ary','time_now'));
    }));

Route::get('/votes_not_yet', array('as' => 'votes_not_yet', function() 
    {
        $time_now = Carbon::now();

        $votes = Vote::get();
        //dd($votes);
        $ary[0] = $votes;
        foreach ($ary[0] as $vote){
           // $candidate = Candidate::find($vote->id);
            $candidate_c = Candidate::where('vote_id', '=', $vote->id)->first();
            if ($candidate_c <> null){
                $ary[1][$vote->id] = $candidate_c->vote_id;
            }
            else{
                $ary[1][$vote->id] = '沒有資料';
            }
        }
        // return our view and Vote information
        return View::make('tasks.votes_not_yet',compact('ary','time_now'));
    }));


Route::get('/votes_done', array('as' => 'votes_done', function() 
    {
        $time_now = Carbon::now();

        $votes = Vote::get();
        //dd($votes);
        $ary[0] = $votes;
        foreach ($ary[0] as $vote){
           // $candidate = Candidate::find($vote->id);
            $candidate_c = Candidate::where('vote_id', '=', $vote->id)->first();
            if ($candidate_c <> null){
                $ary[1][$vote->id] = $candidate_c->vote_id;
            }
            else{
                $ary[1][$vote->id] = '沒有資料';
            }
        }
        // return our view and Vote information
        return View::make('tasks.votes_done',compact('ary','time_now'));
    }));


Route::get('/candidate_data_show/{id}', array('as' => 'candidate_data_show', function($id) 
    {
        $candidates = Candidate::where('vote_id', '=', $id)->get();
       
        // return our view and Vote information
        return View::make('tasks.candidate_data_show',compact('candidates'));
    }));

Route::get('/candidates_select/', array('as' => 'candidates_select', function()
{
    $find_s = false;
    $srch_msg = "";
    $array_s = array();
    $array_s_n = array();
    $data = Input::all();
    (count($data));
    //dd($data);
    //dd(array_key_exists("vote_id",$data));
    if (array_key_exists("vote_id",$data)){
        
            $vote_id = $data['vote_id'];
            //dd('o');
            $account = $data['account'];
            Session::put('vote_id', $vote_id);
            Session::put('account', $account);
        }
    else{
        $vote_id = Session::get('vote_id');
        $account = Session::get('account');
        //$search_text = $data['candidate_search'];
    }

    
    
    
    // if ($data['candidate_search'])
    // {
    //     $search_text = $data['candidate_search'];
    // }
    //dd($search_text);
    

//      WHERE (a=1 OR b=1) AND (c=1 OR d=1)*****
//    Acount::where(function ($query) {
//        $query->where('username', '=', $data['account'])
//          ; })->where(function ($query) {
//        $query->where('c', '=', 1)
//            ->orWhere('d', '=', 1);
//    });

    try {
        $account = Account::where('vote_id', '=', $vote_id)->where('username', '=', $account)->firstorfail();
        $account_id = $account->id;
        $candidates = $account->candidates()->get();

        if (!$candidates->isEmpty())
        {
            $err = "此籤號已於" . $candidates[0]->updated_at . "投票";
            return View::make('tasks.index2', compact('votes','err'));
        }
///////
        //$vote_id =$data['vote_id'];
        $vote = Vote::find($vote_id);
       //dd($vote);
        $time_now = Carbon::now();
        if ($vote->start_at > $time_now)
        {
            $err = '此投票活動尚未開始';
            return View::make('tasks.index2', compact('votes','err'));
        }
        elseif  ($vote->end_at < $time_now)
        {
            //dd($vote[0]->end_at,'ooo',$time_now,'ppp',$vote_id);
            $err = '此投票活動已經結束';
            return View::make('tasks.index2', compact('votes','err'));
        }
        else
        {
       // dd($vote[0]->can_select);
        $can_select = $vote->can_select;
        $err_msg = '';
        Session::put('account_id', $account_id);
        $candidates = Candidate::where('vote_id', '=', $vote_id)->get();

         if (!array_key_exists("vote_id",$data)){
        //dd($candidates);
            foreach ($candidates as $candidate){
                for ($x = 0; $x < $can_select; $x++)
                {

                    //$num = strpos($candidate->cname,$search_text);
                    if ($data['candidate_search'][$x] <> ""){
                    if (is_integer(strpos($candidate->cname,$data['candidate_search'][$x])))
                    {
                        if ($find_s <> true)
                        {
                             $array_s[]= $candidate;
                             $find_s = true;
                        }
                         
                    }
                    }
                }
                if ($find_s <> true)
                {
                    $array_s_n[]= $candidate;
                }
                $find_s = false;
                
            }
            $candidates = $array_s;


           
for ($x = 0; $x < count($array_s_n); $x++)
{
    $candidates[] = $array_s_n[$x];
}



            if ($array_s == null){
                $srch_msg = "搜尋不到";
            }
        }


        return View::make('tasks.candidate_select', compact('candidates', 'account_id','can_select','err_msg','srch_msg'));
        }

    } catch(ModelNotFoundException $e) {
        $err = "投票代號或籤號錯誤";
        return View::make('tasks.index2', compact('votes','err'));
    }

}));

Route::get('/school_select/', array('as' => 'school_select', function()
{
            $err='';
           return View::make('tasks.school_select', compact('err'));

   }));
Route::get('/vote_result_show_index/', array('as' => 'vote_result_show_index', function()
{
    $data = Input::all();
    $school_no = $data['school_no'];
    $votes = Vote::where('school_no', '=', $school_no)->get();
    $time_now = Carbon::now();
    if (!$votes->isEmpty())
    {
            foreach ($votes as $vote){
           // echo $vote->school_no, $vote->id, $vote->vote_title;
//            if ($candidate_c <> null){
//                $ary[1][$vote->id] = $candidate_c->vote_id;
//            }
//            else{
//                $ary[1][$vote->id] = '沒有資料';
//            }
        }

//        $err = "投票代號或籤號錯誤";
        return View::make('tasks.vote_result_show_index', compact('votes','time_now'));
    }
    else
    {
        $err = "此學校代號無投票項目  或  學校代號錯誤";
        return View::make('tasks.school_select', compact('err'));
    }

}));

Route::get('/vote_result_show/{id}', array('as' => 'vote_result_show', function($id){
          $candidates = Candidate::where('vote_id', '=', $id)->orderBy('total_count', 'desc')->get();
//        $votes = Vote::where('school_no', '=', $id)->get();
//        $school_no = $votes[0]->school_no;
//        $vote_amount = $votes[0]->vote_amount;
//        $redo = 0;
//        $data = [$accounts,$school_no,$vote_amount,$redo];
          //$data_test = "test";
        // return our view and Vote information


    return View::make('tasks.vote_result_show',compact('candidates','id'));
}))->where('id','[0-9]+');

Route::get('/vote_result_show_test/{id}', array('as' => 'vote_result_show_test', function($id){
          $candidates = Candidate::where('vote_id', '=', $id)->orderBy('total_count', 'desc')->get();
//        $votes = Vote::where('school_no', '=', $id)->get();
//        $school_no = $votes[0]->school_no;
//        $vote_amount = $votes[0]->vote_amount;
//        $redo = 0;
//        $data = [$accounts,$school_no,$vote_amount,$redo];
          //$data_test = "test";
        // return our view and Vote information


    return View::make('tasks.vote_result_show_test',compact('candidates','id'));
}));


Route::get('/votes_from_whom/{id}', array('as' => 'votes_from_whom', function($id){
    $accounts = Candidate::find($id)->accounts()->get();

//        $votes = Vote::where('school_no', '=', $id)->get();
//        $school_no = $votes[0]->school_no;
//        $vote_amount = $votes[0]->vote_amount;
//        $redo = 0;
//        $data = [$accounts,$school_no,$vote_amount,$redo];
    //$data_test = "test";
    // return our view and Vote information


    return View::make('tasks.votes_from_whom',compact('accounts'));
}));
Route::get('/candidates_select_result/', array('as' => 'candidates_select_result', function()
{
    $cadidates_checked = Input::get('candidate');
    if(is_array($cadidates_checked))
    {
        $account_id = Session::get('account_id', '這是預設值，沒設定過就用這個囉！！');
        //echo $account_id;

       //dd('5');
        $account = Account::find($account_id);
        $vote = Vote::find($account->vote_id);
        if (count($cadidates_checked)>$vote->can_select){
            $can_select = $vote->can_select;
            $candidates = Candidate::where('vote_id', '=', $account->vote_id)->get();
            $account_id = Session::get('account_id', '這是預設值，沒設定過就用這個囉！！');
            $err_msg = '';
            $srch_msg = '';
                echo '<script type="text/javascript">';
                echo 'alert("超過可選數目!")';
                echo '</script>';
            return View::make('tasks.candidate_select',compact('candidates', 'account_id','err_msg','can_select','srch_msg'));
        }
        else//再一次判斷是否投過票了！*************
        {
            echo "投票完成！<br>您選擇的是：<br>";
            //$data = Input::all();
            //dd($data['candidate'][0]);
             foreach ($cadidates_checked as $candidate_id){
                 $candidate = Candidate::find($candidate_id);
                 echo ($candidate->cname);
                 echo "<br>";
                 $candidate->accounts()->save($account);
                 $candidate->total_count ++;
                 $candidate->save();
             }
        }
        //echo $account_id;
    }
    else{

            $account_id = Session::get('account_id', '這是預設值，沒設定過就用這個囉！！');
            //echo $account_id;

           //dd('5');
            $account = Account::find($account_id);
            $vote = Vote::find($account->vote_id);
            $can_select = $vote->can_select;
            $candidates = Candidate::where('vote_id', '=', $account->vote_id)->get();
            $account_id = Session::get('account_id', '這是預設值，沒設定過就用這個囉！！');
            $err_msg = '';
            $srch_msg = '';
                echo '<script type="text/javascript">';
                echo 'alert("您沒有選擇任何選項!")';
                echo '</script>';
            return View::make('tasks.candidate_select',compact('candidates', 'account_id','err_msg','can_select','srch_msg'));
    }
    // return our view and Vote information
   // return View::make('tasks.candidate_select_result',compact('candidates'));
}));

Route::get('/account_data_show/{id}', array('as' => 'account_data_show', function($id) 
    {
        $accounts = Account::where('vote_id', '=', $id)->get();
        $votes = Vote::where('id', '=', $id)->get();
        $start_at = $votes[0]->start_at;
        $end_at = $votes[0]->end_at;
        $school_no = $votes[0]->school_no;
        $vote_amount = $votes[0]->vote_amount;
        $redo = 0;
        $data = [$accounts,$school_no,$vote_amount,$redo,$start_at,$end_at];

        // return our view and Vote information
        return View::make('tasks.account_data_show',compact('data'));
    }));

Route::get('/account_data_redo/{id}', array('as' => 'account_data_redo', function($id) 
    {
        $accounts = Account::where('vote_id', '=', $id)->get();
        $votes = Vote::where('id', '=', $id)->get();
        $school_no = $votes[0]->school_no;
        $start_at = $votes[0]->start_at;
        $end_at = $votes[0]->end_at;
        $vote_amount = $votes[0]->vote_amount;
        $redo = 1;
        $data = [$accounts,$school_no,$vote_amount,$redo,$start_at,$end_at];
        
        $vote_data=[$id,$vote_amount];
        //$redo = 1;
        //echo "id",$votes[0]->$id,"amount",$votes[0]->vote_amount;
        Session::put('vote_id', $id);
        Session::put('vote_data', $vote_data);
        Session::put('redo', 1);

        // return our view and Vote information
        return View::make('tasks.account_data_show',compact('data'));
    }));

// Route::get('/account_redo_true/{id}', array('as' => 'account_redo_true', function($id) 
//     {
//         //$accounts = Account::where('vote_id', '=', $id)->get();
//         Account::where('vote_id', '=', $id)->delete();
//         $votes = Vote::where('id', '=', $id)->get();
//        // $vote_id = $vote_new[0]->id;
//         $vote_data=[$vote->$id,$vote->vote_amount];
//         //$redo = 1;
//         Session::put('vote_data', $vote_data);
//         Session::put('redo', 1);
//         //$data = [$accounts,$school_no,$vote_amount,$redo];
        

//         // return our view and Vote information
//         //return View::make('tasks.account_data_show',compact('data'));
//     }));

Route::get('/account_redo_true/{id}', array('as' => 'account_redo_true', 'uses' => 'VoteController@account_create',function($id) 
    {
        Account::where('vote_id', '=', $id)->delete();
        $votes = Vote::where('id', '=', $id)->get();
        $vote = $votes[0];
        $vote_data=[$votes[0]->$id,$votes[0]->vote_amount];
        //$redo = 1;
        echo "id",$votes[0]->$id,"amount",$votes[0]->vote_amount;
        Session::put('vote_data', $vote_data);
        Session::put('redo', 1);

    }));

Route::get('/account_data_del/{id}', ['as' => 'account_data_del', 'uses' => 'AccountController@clean']);

// Route::get('/{id}/{s}', array('as' => 'vote.edit2', function($id,$s) 
//     {
//         // return our view and Vote information
//         // return View::make('tasks.vote-edit') // pulls app/views/nerd-edit.blade.php
//         //     ->with('vote', Vote::find($id));

//          return View::make('tasks.vote-edit2', array('id' => $id,'s'=>$s,'vote'=>Vote::find($id)));
//     }));

Route::get('/test3', function()
{

    $vote = Vote::find(51);

    $candidates = Candidate::where('vote_id', '=', 54)->get();
    foreach ($candidates as $candidate){
        $dump_d = Candidate::with('accounts')->find($candidate->id);
        dd($dump_d);
    }


// $account = Account::find(1);
// $candidate = Candidate::find(10);
// $candidate->accounts()->detach();

// // return $candidate->accounts;
// return Candidate::with('accounts')->find($candidate->id);


});


Route::get('/test4', function() {

    $vote = Vote::find(51);
    $time2 = $vote->start_at;
    $time3 = Carbon::now();



    printf("Now: %s", $time2);
    printf("Now: %s", $time3);
    if ($time2>$time3)
    {

        echo ">";
    }

});


    Route::get('/test', function()
{
    // $artist = new Artist;
    // $artist->name = 'Eve 6';
    // $artist->save();


                    // $candidate = new Candidate;
                    // $candidate->cname=$data_array1[0];
                    // $candidate->job_title=$data_array1[1];
                    // $candidate->sex=$data_array1[2];
                    // $candidate->vote_id=42;
                    // $candidate->total_count=0;
                    
                    // $account = new Account;
                    // $account->username;
                    // $account->vote_id;
                    // $account->finish_at;

     $vote = Vote::find(49);

     $account = new Account;
     $account->username='sandy';
     $account->vote_id=49;
     $account->finish_at="0000-00-00 00:00:00";
     $account->vote()->associate($vote);
     $account->save();

     $account2 = new Account;
     $account2->username='sandy2';
     $account2->vote_id=2;
     $account2->finish_at="0000-00-00 00:00:00";
     $account2->vote()->associate($vote);
     $account2->save();

     $candidate = new Candidate;
     $candidate->cname = 'Naruto Uzumaki';
     $candidate->job_title='yy';
     $candidate->sex='男';
     $candidate->vote_id=49;
     $candidate->total_count=2;

     $candidate->save();
     $candidate->accounts()->save($account);
     $candidate->accounts()->save($account2);

    // $account = Account::find(1);
   // $candidate = Candidate::find(10);
   // $candidate->accounts()->detach();
   
    // // return $candidate->accounts;
    // return Candidate::with('accounts')->find($candidate->id);

   
});


Route::get('/test2', function()
{
    function GeraHash($qx){ 
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
        $Caracteres = 'ABCDEFGHIJKLMPQRSTUVXWYZ123456789'; 
        $QuantidadeCaracteres = strlen($Caracteres); 
        $QuantidadeCaracteres--; 

        $Hash=NULL; 
            for($x=1;$x<=$qx;$x++){ 
                $Posicao = rand(0,$QuantidadeCaracteres); 
                $Hash .= substr($Caracteres,$Posicao,1); 
    } 

return $Hash; 
} 
echo GeraHash(3); 
});



Route::delete('/api/todos/clean', 'TodoController@clean');
Route::resource('/api/todos', 'TodoController');
// Route::controller('/api/todos', 'TodoController');

Route::resource('/api/users', 'UserController');
Route::delete('/api/users/clean', 'UserController@clean');

Route::resource('/api/votes', 'VoteController');
Route::delete('/api/votes/clean', 'VoteController@clean');
Route::delete('/api/accounts/clean', 'AccountController@clean');

Route::resource('votes', 'VoteController');
Route::resource('candidates', 'CandidateController');
Route::resource('accounts', 'AccountController');

