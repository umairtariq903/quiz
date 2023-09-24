<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use Response;

class QuizController extends Controller
{
    //show quiz 1st question
    public function showQuiz(Request $request){
    	$name = $request->name;
    	$questionId = $request->question;
    	Session::put('username', $name);
    	$question = $this->getQuestion($questionId);
    	return Response::json($question); 
    }

    // reusable function to retrieve question by id
    public function getQuestion($id){
    	$questions = Question::with('answers')->where('id',$id)->get();
    	return $questions;
    }

    // logic for next question button. updates results for current question and returns the next question 
    public function nextQuestion(Request $request){
    	$answer = $request->answer;
    	$questionId = $request->question;
    	$status = $this->checkAnswerStatus($answer,$questionId);
    	$this->updateResult($status);
    	$nextQuestion = $this->getQuestion($questionId+1);
    	return Response::json($nextQuestion);
    }

    // logic for skip question button. updates results for current question and returns the next question
    public function skipQuestion(Request $request){
    	$questionId = $request->question;
    	$status = 'skip_ans';
    	$this->updateResult($status);
    	$nextQuestion = $this->getQuestion($questionId+1);
    	return Response::json($nextQuestion);
    }

    
    // Reusable function to check whether answer was right or wrong
    public function checkAnswerStatus($answer,$questionId){
    	$answerRecord = Answer::where('answer',$answer)->where('question_id',$questionId)->first();
    	if($answerRecord['correct_answer']){
    		return 'correct_ans';	
    	}
    	else{
    		return 'wrong_ans';	
    	}
    }

    // retrieve results for displaying to user
    public function getResult(){
    	$user = Session::get('username');
    	$result = Result::where('username',$user)->first();
    	return Response::json($result);	
    }


    // A bit of long but simple logic to update the results table so we can fetch simply (alternative approaches can be followed)
    public function updateResult($status){
    	$user = Session::get('username');
    	$result = Result::where('username',$user)->first();
    	if($result){
    		if($status == 'correct_ans'){
    			Result::where('username',$user)->update(['correct_ans'=>($result['correct_ans']+1)]);
    		}
    		elseif($status == 'wrong_ans'){
    			Result::where('username',$user)->update(['wrong_ans'=>($result['wrong_ans']+1)]);
    		}
    		else{
    			Result::where('username',$user)->update(['skip_ans'=>($result['skip_ans']+1)]);	
    		}
    	}
    	else{
    		$result = new Result();
    		$result->username = $user;
    		if($status == 'correct_ans'){
    			$result->correct_ans = 1;
    		}
    		elseif($status == 'wrong_ans'){
    			$result->wrong_ans = 1;
    		}
    		else{
    			$result->skip_ans = 1;	
    		}
    		$result->save();	
    	}
    }

}
