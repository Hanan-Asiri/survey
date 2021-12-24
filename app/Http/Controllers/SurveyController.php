<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
class SurveyController extends Controller
{
   public function GetSurvey()
   {
    return view('survey.create');
   }
   public function GetAnswre(Request $request)
   {
    $user = $request->user(); 
    $data = DB::table('question')
    ->join('answers','question.id', '=', 'answers.question_id')
    ->get();
  
    return view('admin.answers',compact('data'));
   }
   public function GetmyAnswre(Request $request)
   {
    $user = $request->user(); 
    $data = DB::table('question')
    ->join('answers','question.id', '=', 'answers.question_id')
    ->where('answers.user_id','=',$user->id)
    ->get();
    return view('my.myanswere',compact('data'));
   }
   public function GetQuestionOptions($id)
   {
      
    $data = DB::select("select consultation.type, 
                         question.id , question.text from consultation,question
                          where question.id_consultation=consultation.id
                          and question.id='".$id."'
                          group by consultation.type,question.id,question.text
                           
                       
                        ");
    
    
    return $data;
   }

   public function GetQuestionResponse($id)
   {
      
    $data = DB::select("select answers.question_id as Question ,count(answers.question_id) as count from answers
    where answers.question_id='".$id."'
    group by answers.question_id
                           
                       
                        ");
    
    
    return $data;
   }
   public function GetAdmin(Request $request)
   {
    
    $user = $request->user(); 
    if($user->id=="10")
    {
        return view('admin.index'); 
    }
    else{
        Session::flush();
        
        Auth::logout();
    
        return redirect('login');
    }
   
   // return view('Admin.home');
   }
   public function GetAllQuestions()
   {
    //$data = DB::table('consultation')
   // ->join('question','question.id', '=', 'consultation.id')
   // ->get();
    
    $data = DB::select("select consultation.type, 
                         question.id , question.text from consultation,question
                          where question.id_consultation=consultation.id
                          group by consultation.type,question.id,question.text
                           
                       
                        ");
    return $data;
   }
   public function updateuser(Request $request)
   {
    $user = $request->user(); 
      
       DB::table('users')
       ->where('id', $user->id)
       ->update(['name' => $request->name,'email'=>$request->mail]);
       return response()->json([
        'res' => 'success Full inserted'
    ]);
   }
   public function getoptions(Request $request)
   {
   
    $data = DB::table('options')
    ->where('options.QuestionID','=',$request->question_id)
    ->get();
    return response()->json([
        'res' => $data
    ]);
   }
   public function getquestionspage()
   {
    $data = DB::select("select * from question ");
    return view('questions.questions',compact('data'));
   }

   public function createoptions()
   {
    $data = DB::select("select * from question");
    return view('admin.createoptions',compact('data'));
   }

   public function getquestionadmin()
   {
    $data = DB::select("select * from question");
    return view('admin.questions',compact('data'));
   }

   public function getmyAccount(Request $request)
   {
    $user = $request->user(); 
    $data = DB::table('users')
    ->where('users.id','=',$user->id)
    ->first();
    return view('my.myaccount',compact('data'));
   }
   public function delete_question(Request $request)
   {
    $user = $request->user(); 
     
    $deleted = DB::delete('delete from question where id = ?',[$request->question_id]);
       return response()->json([
        'res' => 'success Full deleted'
    ]);
   }
   public function update_question(Request $request)
   {
    $user = $request->user(); 
     
       DB::table('question')
       ->where('id', $request->question_id)
       ->update(['text' => $request->text]);
       return response()->json([
        'res' => 'success Full updated'
    ]);
   }
   public function create_question(Request $request)
   {
    $id= DB::select("select max(id) as id from question");
    $num=$id[0]->id;
    $num++;
  
    
    $user = $request->user(); 
    $rowBook = [
        'id' => $num,
        'text' => $request->text,
        'id_consultation'=>"1"
        
    ];
    DB::beginTransaction();
    try {
        DB::table('question')->insert($rowBook);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        dd($e);
    }

   
    return response()->json([
     'res' => 'success Full inserted'
 ]);
   }

   public function create_newanswer(Request $request)
   {
    $user = $request->user(); 
    $rowBook = [
        'question_id' => $request->question_id,
        'value' => $request->value,
        'user_id' => $user->id,
        'created_at' => Carbon::now(),
        'updated_at'=> Carbon::now(),
        
    ];
    DB::beginTransaction();
    try {
        DB::table('answers')->insert($rowBook);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        dd($e);
    }

   
    return response()->json([
     'res' => 'success Full inserted'
 ]);
   }

   public function create_newoption(Request $request)
   {
      
    $id= DB::select("select max(OptionID) as id from options");
    $num=$id[0]->id;
    $num++;
    $user = $request->user(); 
    $rowBook = [
        'OptionID'=>$num,
        'QuestionID' => $request->question_id,
        'OptionText' => $request->text,
        
    ];
    DB::beginTransaction();
    try {
        DB::table('options')->insert($rowBook);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        dd($e);
    }

   
    return response()->json([
     'res' => 'success Full inserted'
 ]);
   }
   public function create(Request $request)
   {
      $checkInDate = new DateTime($request->dpirth);
      $rowBook = [
         'id' => DB::selectOne(DB::raw('select uuid_short() as uuid'))->uuid,
         'fullname' => $request->fullname,
         'birth_date' => $checkInDate->format('Y-m-d'),
         'address' => $request->Address,
         'email'=> $request->mail,
         'password'=>$request->password
     ];

     $users = [
      'name' => $request->fullname,
      'password' => bcrypt($request->password),
      'email' => $request->mail,
      'email_verified_at'=> Carbon::now(),
      'created_at'=> Carbon::now(),
      'updated_at'=> Carbon::now()
  ];




     DB::beginTransaction();
     try {
         DB::table('questionnaire')->insert($rowBook);
         DB::table('users')->insert($users);
         DB::commit();
     } catch (\Exception $e) {
         DB::rollback();
         dd($e);
     }

    
     return response()->json([
      'res' => 'success Full inserted'
  ]);
    
   }
}
