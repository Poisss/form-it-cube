@extends('wrap')
@section('title',$data['title'])
@section('content')
    <div class="background" style="background-image: url('{{asset('public/'.$data['background'])}}')">

    </div>
    <h1 class="center form-title">{{$data['title']}}</h1>
    <form action="{{route('questionnaire')}}" method="POST">
        @method('POST')
        @csrf
        {{-- {{dd($data)}} --}}
        <input type="hidden" name="id" value="{{$data['id']}}">
        @foreach ($data['questions'] as $item)
            <div class="question-block">
                <div class="red">
                    @if ($item['required']=='1')
                        <p>
                            *
                        </p>
                    @endif
                </div>
                <div>
                    {{-- {{dd($item)}} --}}
                    @if ($item['type']=='title' || $item['type']=='text')
                        @if ($item['type']=='title')
                            <h2>{{$item['question']}}</h2>
                        @else
                            <p class="title">{{$item['question']}}</p>
                        @endif
                    @else
                        @if ($item['type']=='agreement')
                            <input type="hidden" name="question[{{$item['id']}}][id]" value="{{$item['id']}}">
                        @else
                            <p class="title">{{$item['question']}}</p>
                            <input type="hidden" name="question[{{$item['id']}}][id]" value="{{$item['id']}}">
                        @endif
                    @endif

                    @if ($item['type']=='text_short' || $item['type']=='email' || $item['type']=='data')
                        <input type="{{($item['type'] == 'text_short') ? 'text' : (($item['type'] == 'email') ? 'email' : (($item['type'] == 'data') ? 'date' : ''))}}" name="question[{{$item['id']}}][value][]" {{($item['required'] == '1') ? 'required' :''}}>
                    @elseif($item['type']=='text_long')
                        <textarea name="question[{{$item['id']}}][value][]" rows="6" {{($item['required'] == '1') ? 'required' :''}}></textarea>
                    @elseif($item['type']=='checkbox')
                        @foreach ($item['option'] as $item1)
                            <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                <div>
                                    <input type="checkbox" class="checkbox" id="question-{{$item['id']}}-{{$loop->index}}" name="question[{{$item['id']}}][value][]" value="{{$item1}}" {{($item['required'] == '1') ? 'required' :''}}>
                                </div>
                                <div>
                                    {{$item1}}
                                </div>
                            </label>
                        @endforeach
                    @elseif($item['type']=='radio')
                        @foreach ($item['option'] as $item1)
                            <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                <div>
                                    <input type="radio" id="question-{{$item['id']}}-{{$loop->index}}" class="radio" name="question[{{$item['id']}}][value][]" value="{{$item1}}" {{($item['required'] == '1') ? 'required' :''}}>
                                </div>
                                <div>
                                    {{$item1}}
                                </div>
                            </label>
                        @endforeach
                    @elseif($item['type']=='select')
                        <select name="question[{{$item['id']}}][value][]" {{($item['required'] == '1') ? 'required' :''}}>
                            <option value="" disabled selected>-</option>
                            @foreach ($item['option'] as $item1)
                                <option value="{{$item1}}">{{$item1}}</option>
                            @endforeach
                        </select>
                    @elseif($item['type']=='agreement')
                        @foreach ($item['option'] as $item1)
                            <label class="option" for="question-{{$item['id']}}-{{$loop->index}}">
                                <div>
                                    <input type="checkbox" class="checkbox" id="question-{{$item['id']}}-{{$loop->index}}" name="question[{{$item['id']}}][value][]" value="{{$item1}}" {{($item['required'] == '1') ? 'required' :''}}>
                                </div>
                                <div>
                                    {{$item1}}
                                </div>
                            </label>
                        @endforeach
                    @endif

                    @if ($item['comment']!=null)
                        <p class="comment">
                            {{$item['comment']}}
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="submit-block">
            <input type="submit" class="submit" value="Отправить">
        </div>
    </form>
@endsection
