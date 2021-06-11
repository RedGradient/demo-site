@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">




                <div class="row">
                    <div class="col">

                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->body }}</p>
                        <p>Автор: {{ $author }}</p>
                        <button class="btn btn-primary btn-sm">
                            {{ $post->likes()->count() }}
                        </button>

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

                                <form type="POST" action="{{ route('posts.destroy', $post->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            @endauth

        </div>
    </div>
@endsection
