@extends('base')

@section('head')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">

                <div class="row">
                    <div class="col">
                        <h3>{{ $post->title }}</h3>
                        <p>
                            <img class="rounded mx-auto d-block" src="{{ asset('/images/'.$post->image) }}" alt="image" style="height: 200px; width: 200px">
                        </p>


                        <p>{{ $post->body }}</p>
                        <p>Автор: {{ $author }}</p>

                        <input type="checkbox" class="btn-check" name="sort" id="like">
                        <label onclick="likeIt()" class="btn btn-outline-primary" id="like_label" for="like"><i class="fas fa-heart"></i> <span id="like_count">{{ $post->likes()->count() }}</span></label>

                    </div>
                </div>


                <div class="row">
                    <div class="col"></div>
                    <div class="col">

                    </div>
                </div>


            </div>

            @auth
                <div class="col-3">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="d-grid gap-2">
                                <a class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">Редактировать</a>

                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}"  >
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endauth

        </div>
    </div>

    <script src="{{ asset('js/likeIt.js') }}"></script>
@endsection
