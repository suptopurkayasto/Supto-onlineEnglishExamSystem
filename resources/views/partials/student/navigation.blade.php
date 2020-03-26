<nav class="navbar navbar-expand-md navbar-light bg-white shadow">
    <div class="container">
        <a class="navbar-brand" href="/">{{ $student->name }}</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                {{--                    <li class="nav-item active">--}}
                {{--                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
                {{--                    </li>--}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ $student->name }}
                        <img width="20" class="rounded ml-2" src="{{ Gravatar::get($student->email) }}" alt="">
                    </a>
                    <div class="dropdown-menu shadow" aria-labelledby="dropdownId">
                        <form action="{{ route('student.logout') }}" method="post" class="" id="studentLogOutForm">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div><!-- /.container -->
</nav>

@section('extra-scripts')
    <script>
        $(document).ready(function () {
        })
    </script>
@endsection
