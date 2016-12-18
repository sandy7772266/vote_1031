<?php

class VoteController extends \BaseController {

	
// public function index()
// 	{		
// 		$tasks = Task::with('user')->orderby('completed')->orderby('completed', 'desc')->orderby('created_at', 'desc')->get();
// 		$users = User::orderby('name')->lists('name', 'id');
		
		
// 		return View::make('tasks.index', compact('tasks', 'users'));	
// 	}


// *
// 	 * Display a listing of the resource.
// 	 *
// 	 * @return Response
	 
// 	public function index()
// 	{
// 		return Response::json(Vote::all());
// 	}





	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$votes = Response::json(Vote::all());
		$err='';
		$votes = Vote::get();

		return View::make('tasks.index2', compact('votes','err'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */


	public function store()
	{
		//
		$data = Input::all();

		$vote = new Vote;
		$vote->school_no=Session::get('school_no');
		$vote->school_name=Session::get('school_name');
		$vote->vote_title=$data['vote_title'];
		$vote->vote_amount=$data['vote_amount'];

		$date_now = $this->getDatetimeNow();
		$date_n = new DateTime("now");
		$date_s = new DateTime($data['start_at']);
		$date_e = new DateTime($data['end_at']);

		if (($date_s< $date_n) or ($date_s > $date_e)){
			//dd($date_now,$data['start_at'] ,$data['end_at'] ) ;
			echo '<script type="text/javascript">';
            echo 'alert("起始時間不可大於結束時間或小於現在時間")';

            echo '</script>';
			return View::make('tasks.vote-insert-first', compact('votes','date_now'));
		}


		$temp_date = date("Y-m-d H:i:s", strtotime($data['start_at']));
		$vote->start_at=$temp_date;
		
		$temp_date = date("Y-m-d H:i:s", strtotime($data['end_at']));
		$vote->end_at=$temp_date;
		//判斷起始時間是否小於結束時間，並且比現在時間大。



		$vote->vote_goal=$data['vote_goal'];
		$vote->can_select=$data['can_select'];
		$vote->public_or_private=$data['public_or_private'];
		$vote->builder_name=Session::get('builder_name');
		$vote->save();

		$vote_new = DB::table('votes')
                    ->orderBy('id', 'desc')
                    //->groupBy('count')
                    //->having('count', '>', 100)
                    ->get();

		$vote_id = $vote_new[0]->id;
		$vote_data=[$vote_id,$vote->vote_amount];
		Session::put('vote_data', $vote_data);
		Session::put('redo', 1);
		$this->account_create();
		//$this->passsec($vote_id);	
		//Session::put('vote_id_insert', $vote_id);                
		//return Redirect::route('vote.insert-second');
		return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
		//Redirect::action('VoteController@passsec', ['id' => $vote_id]);



	}
    //修改部分 end

   
	public function account_create()
	{
		
		$redo = Session::get('redo');
		Session::forget('redo');
		$vote_id = Session::get('vote_id');
		if ($redo == 1){
			
			Account::where('vote_id', '=', $vote_id)->delete();
		}
		$vote_data = Session::get('vote_data');
		
		
		$vote_amount = $vote_data[1];
		
			// $table->increments('id');
			// $table->string('username');
			// $table->integer('vote_id')->unsigned();
		for($x=0;$x<=$vote_amount-1;$x++){ 
		$str_rand = $this->GeraHash(6);
		$zero_str_len = strlen($vote_amount) - strlen($x) ;
		$zero_str = '';
			for($y=1;$y<=$zero_str_len;$y++){ 
				$zero_str .= '0';
			}
		$index_no = $zero_str.$x;
		$Caracteres = 'ABCDEFGHKLMPQRSTUVXWYZ23456789';
		$index_str = '';
			for ($y=0;$y<strlen($index_no);$y++){ 
				$index_ary[$y] = intval(substr($index_no, $y, 1));
				$index_ary_insert[$y] = substr($Caracteres, $index_ary[$y]+7, 1);
				$index_str .= $index_ary_insert[$y];
			}
			//echo $index_str."**";
		$str_rand = substr($str_rand, 0, 2).$index_str.substr($str_rand, 3, 5); 
		$username_ary[$x] = $str_rand;

 		}    
 		for($x=0;$x<=$vote_amount-1;$x++){ 
	 		$account = new Account;
			$account->username = $username_ary[$x];
			$account->vote_id = $vote_data[0];
			$account->save();    
		}    
		//Session::flush();
		//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	 
		if ($redo == 1){
			return Redirect::route('votes_not_yet');
			//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
		}
		//Session::put('vote_id_insert', $vote_id);
		//return Redirect::route('vote.insert-second', array('vote_id' => $vote_id));	
        //return View::make('tasks.vote-insert-second');

	}


	function GeraHash($qx){ 
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
        $Caracteres = 'ABCDEFGHKLMPQRSTUVXWYZ23456789'; 
        $QuantidadeCaracteres = strlen($Caracteres); 
        $QuantidadeCaracteres--; 

        $Hash=NULL; 
            for($x=1;$x<=$qx;$x++){ 
                $Posicao = rand(0,$QuantidadeCaracteres); 
                $Hash .= substr($Caracteres,$Posicao,1); 
		    } 

		return $Hash; 
	} 


	function getDatetimeNow() {
	    $tz_object = new DateTimeZone('Asia/Taipei');
	   
	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    $date_time = $datetime->format('d/m/Y H:i:s A');
	    return $date_time;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'hello';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

		//修改部分
	public function update($id)
	{
		//$data = Input::get();
		$vote = Vote::find($id);

		$vote -> fill(Input::all());
		


		// if(isset($data['vote_title'])){
		// 	$vote->vote_title = $data['vote_title'];

			//return Response::json($vote);
		

		// if(isset($data['done'])){
		// 	$todo->done = $data['done'];
		// }

		$vote->save();

		$arr = [
			'flash' => ['type' => 'success',
						'msg' => '更新成功！']
		];

		//return Redirect::to('/');
		return Redirect::route('votes_not_yet');
	}
    //修改部分 end

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$vote = Vote::find($id);
		$candidates = Candidate::where('vote_id', '=', $id)->get();
		foreach ($candidates as $candidate){
			 $candidate->accounts()->detach();
			 $candidate->delete();
		}
		Account::where('vote_id', '=', $id)->delete();
		$vote->delete();
		$arr = [
			'flash' => ['type' => 'success',
						'msg' => '待辦事項已刪除！']
		];

		return Redirect::route('votes_not_yet');
	}


public function update2($id)
	{
		$arr = 'o';
		return Response::json($arr);
	}
    //修改部分 end


     //尚未用到
public function redo($id)
	{
		$accounts = Account::where('vote_id', '=', $id)->get();
        $votes = Vote::where('id', '=', $id)->get();
        $school_no = $votes[0]->school_no;
        $vote_amount = $votes[0]->vote_amount;
        $redo = 1;
        $data = [$accounts,$school_no,$vote_amount,$redo];
        
        $vote_data=[$id,$vote_amount];
        //$redo = 1;
        //echo "id",$votes[0]->$id,"amount",$votes[0]->vote_amount;
        Session::put('vote_id', $id);
        Session::put('vote_data', $vote_data);
        Session::put('redo', 1);

	}




}
