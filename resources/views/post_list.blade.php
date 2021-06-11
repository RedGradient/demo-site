@extends('base')

@section('content')

    <div class="container-md">
        <div class="row">
            <div class="col-9">
                @foreach($posts as $post)

                    <div class="row border border-primary rounded-3 mb-2">

                        <!-- Левый блок -->
                        <div class="col-2 border-end">
                            <img class="rounded mx-auto d-block" src="{{ asset('/images/'.$post->image) }}" alt="image" style="height: 100px; width: 100px">
                        </div>
                        <!--  -->

                        <!-- Правый блок -->
                        <div class="col">

                            <!-- Заголовок -->
                            <div class="row border">
                                <div class="col">
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                </div>
                            </div>
                            <!--  -->

                            <!-- Краткое описание -->
                            <div class="row">
                                <div class="col">
                                    <p>{{ $post->description }}</p>
                                </div>
                            </div>
                            <!--  -->

                            <div class="row border">
                                <div class="col">
            {{--                        <span class="text-secondary">Июн 8`21 в 12:35</span>--}}
                                    <span class="text-secondary">{{ $post->created_at }}</span>
                                </div>
                                <div class="col text-end">

                                    <p>Нравится: {{ $post->likes()->count() }}</p>

                                </div>
                            </div>

                        </div>
                        <!--  -->

                    </div>

                @endforeach

                    <span class="">{{ $posts->links() }}</span>
            </div>

            <div class="col-3">

                <div class="d-grid gap-2">
                    <div class="btn-group">
                        <a id="date" class="btn btn-info d-block" data-bs-toggle="button" aria-pressed="true">Дата</a>
                        <a id="popularity" class="btn btn-info d-block" data-bs-toggle="button" aria-pressed="true">Популярность</a>
                    </div>
                    <div class="btn-group">
                        <a id="asc" class="btn btn-info d-block" data-bs-toggle="button" aria-pressed="true">Возрастание</a>
                        <a id="desc" class="btn btn-info d-block" data-bs-toggle="button" aria-pressed="true">Убывание</a>
                    </div>
                    <a href="" id="sort" class="btn btn-primary d-block">Сортировать</a>
                </div>

            </div>
        </div>

    </div>

@endsection
