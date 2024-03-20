<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Form;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {

        $form=Form::all();
        return view('admin.index')->with('data',$form);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Form $form)
    {
        $data=[
            'title'=> $form->title,
            'questionnaires'=> $form->questionnaire->map(function($item) {
                return [
                    'id' => $item->id,
                    'answers'=>$item->answer->map(function($item1) {
                        return[
                            'answer'=>$item1->answer,
                            'question'=>$item1->question->question
                        ];
                    })
                ];
            })
        ];
        return view('admin.show')->with('data',$data);
    }

    public function edit(Form $form)
    {
        //
    }

    public function update(Request $request, Form $form)
    {
        //
    }

    public function destroy(Form $form)
    {
        //
    }
    public function showform(Form $form)
    {
        $data=[
            'id' => $form->id,
            'title' => $form->title,
            'background' => $form->background,
            'questions' => $form->question->map(function($item) {
                return [
                    'id' => $item->id,
                    'question' => $item->question,
                    'required' => $item->required,
                    'comment' => $item->comment,
                    'type' => $item->type,
                    'option'=>$item->option->map(function($item2) {
                        return $item2->option;
                    })
                ];
            })
        ];
        return view('user.form')->with('data',$data);
    }
    public function questionnaire(Request $request){
        $questionnaire=Questionnaire::create(["form_id"=>$request->id]);
        foreach($request->question as $key => $value){
            $answer='';
            foreach($value['value'] as $key1 => $value1){
                $answer.=($key1==0?$value1:'|'.$value1);
            }
            Answer::create(["questionnaire_id"=>$questionnaire->id,"question_id"=>$value['id'],"answer"=>$answer]);
        }
        return redirect()->route('successform',['form' => $request->id]);
    }
    public function successform(Form $form){
        $data=[
            'id' => $form->id,
            'title' => 'Спасибо!',
            'background' => $form->background,
        ];
        return view('user.successform')->with('data',$data);
    }
}
