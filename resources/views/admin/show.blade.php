@extends('wrap')
@section('title','Форма '.$data['title'])
@section('content')
    <div class="background" style="background-image: url('{{asset('public/img/background/background.jpg')}}')">
        {{-- {{dd($data)}} --}}
    </div>
    <h1>
        Форма. {{$data['title']}}
    </h1>
    <table>
        @foreach($data['questionnaires'] as $key =>$value)
            <thead>
                <tr>
                    <th colspan="2"><h2 class="center">Анкета №{{$value['id']}}</h2></th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th><h2>Вопрос</h2></th>
                    <th><h2>Ответ</h2></th>
                </tr>
            </thead>
            <tbody>
                @foreach($value['answers'] as $key1 =>$value1)
                    <tr>
                        <th>{{$value1['question']}}</th>
                        <th>{{$value1['answer']}}</th>
                    </tr>
                @endforeach
            <tbody>
        @endforeach
    </table>
@endsection
