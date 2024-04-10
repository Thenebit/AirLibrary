    <!-- @if (auth()->check())
        @if (auth()->user()->role == 0)
            @include('pages.student.home')
        @elseif (auth()->user()->role == 1)
            @include('pages.admin.home')
        @endif
    @endif -->
