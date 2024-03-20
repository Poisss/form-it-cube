@extends('wrap')
@section('title','Формы')
@section('content')
    <div class="background" style="background-image: url('{{asset('public/img/background/background.jpg')}}')">

    </div>
    <a href=""><button class="red">Создать форму</button></a>
    <table>
        <thead>
            <tr>
              <th>Название</th>
              <th>Фон</th>
              <th>Автор</th>
              <th>Дата создания</th>
              <th>Действие</th>
            </tr>
          </thead>
        <tbody>
            @foreach($data as $key =>$value)
                <tr>
                    <th>{{$value->title}}</th>
                    <th><img src="{{asset('public/'.$value->background)}}" alt="" style="width: 200px"></th>
                    <th>{{$value->title}}</th>
                    <th>{{$value->created_at}}</th>
                    <th>
                        <a href="{{route('show',['form' => $value->id])}}"><button>Посмотреть</button></a>
                        <a href=""><button class="red">Изменить</button></a>
                        <a href=""><button class="red">Удалить</button></a>
                        <a href=""><button class="red">Скачать</button></a>
                    </th>
                </tr>
            @endforeach
        <tbody>
    </table>
@endsection
