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
                            <div class="row">
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

                            <div class="row">
                                <div class="col">
                                    <span class="text-secondary">{{ $post->created_at }}</span>
                                </div>
                                <div class="col text-end">

                                    <span class="text-secondary">Нравится: {{ $post->likes()->count() }}</span>

                                </div>
                            </div>

                        </div>
                        <!--  -->

                    </div>

                @endforeach

                <span class="p-2">{{ $posts->links() }}</span>

            </div>

            <div class="col-1"></div>

            <div class="col-2">
                <div class="d-grid gap-2">
                    <div class="btn-group">
                        <input onclick="setSortParam(this)" type="radio" class="btn-check" name="sort" id="date" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="date">Дата</label>

                        <input onclick="setSortParam(this)" type="radio" class="btn-check" name="sort" id="popularity" autocomplete="off">
                        <label class="btn btn-outline-primary" for="popularity">Популярность</label>
                    </div>
                    <div class="btn-group">
                        <input onclick="setSortParam(this)" type="radio" class="btn-check" name="order" id="asc" autocomplete="off">
                        <label class="btn btn-outline-primary" for="asc">Возрастание</label>

                        <input onclick="setSortParam(this)" type="radio" class="btn-check" name="order" id="desc" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="desc">Убывание</label>
                    </div>
                    <a href="@if(str_contains(Request::fullUrl(), '?'))&sort=date&order=desc @else?sort=date&order=desc @endif" id="sort" class="btn btn-primary">Сортировать</a>
{{--                    <a href="" id="sort">sort</a>--}}
                </div>
            </div>


        </div>

    </div>


    <script src="{{ asset('js/setSortParam.js') }}"></script>

@endsection
