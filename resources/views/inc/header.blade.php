<header class="mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" viewBox="0 0 192.756 192.756"><g fill-rule="evenodd" clip-rule="evenodd">
{{--                        <path fill="#fff" d="M0 0h192.756v192.756H0V0z"/>--}}
                        <path d="M128.234 83.279v26.215h2.909V87.197h.068l9.424 10.496 9.447-10.496h.066v22.297h2.907V83.279h-2.907l-9.513 10.605-9.492-10.605h-2.909zM162.586 96.412c0 7.547 6.189 13.531 13.666 13.531 7.48 0 13.67-5.984 13.67-13.531 0-7.511-6.189-13.598-13.67-13.598-7.477 0-13.666 6.087-13.666 13.598zm24.416-.034c0 5.915-4.805 10.853-10.75 10.853-5.949 0-10.744-4.938-10.744-10.853 0-5.946 4.729-10.852 10.744-10.852 6.018 0 10.75 4.906 10.75 10.852zM74.952 83.263v26.231h4.865c4.104 0 7.234-.523 10.366-3.311 2.888-2.57 4.275-5.941 4.275-9.771 0-3.895-1.354-7.407-4.342-9.981-3.101-2.645-6.297-3.168-10.231-3.168h-4.933zm5.041 2.716c3.094 0 5.739.415 8.138 2.538 2.257 1.983 3.412 4.869 3.412 7.861 0 2.923-1.117 5.669-3.273 7.687-2.399 2.262-5.078 2.713-8.277 2.713h-2.126V85.979h2.126zM103.977 83.263v26.231h13.593v-2.717h-10.675v-9.084h10.367v-2.712h-10.367v-9.002h10.675v-2.716h-13.593zM63.209 92.623l3.964-8.872-2.577-.937-3.269 9.076 1.882.733zM53.508 101.838c0-4.174-2.882-5.878-6.292-7.373l-1.742-.766c-1.774-.8-4.106-1.846-4.106-4.104 0-2.398 2.018-4.069 4.349-4.069 2.23 0 3.479 1.042 4.525 2.852l2.328-1.495c-1.39-2.575-3.86-4.069-6.779-4.069-3.897 0-7.339 2.608-7.339 6.677 0 3.756 2.642 5.321 5.702 6.714l1.6.693c2.43 1.113 4.835 2.156 4.835 5.215 0 2.959-2.574 5.117-5.396 5.117-2.814 0-4.866-2.191-5.25-4.869l-2.852.799c.837 4.07 3.965 6.783 8.176 6.783 4.553 0 8.241-3.513 8.241-8.105zM30.955 85.979v-2.716H15.302v2.716h6.33v23.515h2.922V85.979h6.401zM2.834 109.494h2.922V83.266H2.834v26.228z"/></g></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/?rubric=Бизнес" class="nav-link px-2 link-dark">Бизнес</a></li>
                <li><a href="/?rubric=Политика" class="nav-link px-2 link-dark">Политика</a></li>
                <li><a href="/?rubric=Экономика" class="nav-link px-2 link-dark">Экономика</a></li>
                <li><a href="/?rubric=Космос" class="nav-link px-2 link-dark">Космос</a></li>
            </ul>


        @guest
            <a href="{{ route('register') }}" class="btn btn-outline-primary m-1" role="button">Регистрация</a>
            <a href="{{ route('login') }}" class="btn btn-outline-info m-1">Войти</a>
        @endguest

        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-outline-success m-1">Написать статью</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary m-1">Выйти</button>
            </form>

        @endauth


        </div>
    </div>
</header>
