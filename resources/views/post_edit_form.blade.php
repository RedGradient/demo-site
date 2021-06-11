@extends('base')

@section('title')Создание статьи@endsection

@section('head')
    <script src="{{ asset('js/app.js') }}"></script>
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <form id="post_create_form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="form-label">Заголовок</p>
                    <input id="title" name="title" class="form-control" value="{{ $post->title }}">
                    <br>
                    <p class="form-label">Краткое описание</p>
                    <input id="description" name="description" class="form-control" value="{{ $post->description }}">
                    <br>
                    <p class="form-label">Текст</p>
                    <input type="text" id="body" name="body" class="form-control" value="{{ $post->body }}">
                    <br>
                    <p class="form-label">Рубрика</p>
                    <select form="post_create_form" name="rubric" class="custom-select custom-select-sm">
                        @foreach($rubrics as $rubric)
                            <option value="{{ $rubric->id }}">{{ $rubric->title }}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input type="file" class="custom-file-input" name="image" id="customFile">
                    <br><br>
                    <input class="btn btn-success" type="submit" value="Опубликовать">
                </form>

            </div>

        </div>
    </div>

@endsection
