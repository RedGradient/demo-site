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
{{--                <p class="form-label">Заголовок</p>--}}
{{--                <input id="title" class="form-control">--}}
{{--                <br>--}}
{{--                <p class="form-label">Краткое описание</p>--}}
{{--                <input id="description" class="form-control">--}}
{{--                <br>--}}
{{--                <p class="form-label">Текст</p>--}}
{{--                <div id="body" class="form-control" contenteditable="true"></div>--}}
{{--                <br>--}}
{{--                <p class="form-label">Рубрика</p>--}}
{{--                <select class="custom-select custom-select-sm">--}}
{{--                    @foreach($rubrics as $rubric)--}}
{{--                        --}}{{--                    <option selected>Open this select menu</option>--}}
{{--                        <option value="{{ $rubric->id }}">{{ $rubric->title }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <br>--}}
{{--                <p class="form-label">Вставьте изображение</p>--}}
{{--                <div class="custom-file">--}}
{{--                    <input type="file" class="custom-file-input" id="customFile">--}}
{{--                    <label class="custom-file-label" for="customFile">Выберите изображение</label>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <button class="btn btn-success" onclick="uploadPost()" type="button" name="button">Опубликовать</button>--}}


                <form id="post_create_form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="form-label">Заголовок</p>
                    <input id="title" name="title" class="form-control">
                    <br>
                    <p class="form-label">Краткое описание</p>
                    <input id="description" name="description" class="form-control">
                    <br>
                    <p class="form-label">Текст</p>
                    <input type="text" id="body" name="body" class="form-control">
                    <br>
                    <p class="form-label">Рубрика</p>
                    <select form="post_create_form" name="rubric" class="custom-select custom-select-sm">
                        {{--                    <option selected>Open this select menu</option>--}}
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
{{--    <script src="{{ asset('js/uploadPost.js') }}"></script>--}}

{{--    <script>--}}
{{--        function uploadPost() {--}}
{{--            let title = $('#title').html();--}}
{{--            let body = $('#body').html();--}}
{{--            let rubric = $('#rubric').html();--}}
{{--            let description = $('#description').html();--}}

{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}

{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: "/posts",--}}
{{--                data: {--}}
{{--                    "title": title,--}}
{{--                    "body": body,--}}
{{--                    "description": description,--}}
{{--                    "rubric": rubric,--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}


@endsection
