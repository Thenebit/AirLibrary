@if (auth()->check())
    @if (auth()->user()->role == 1)
        @include('pages.admin.home')
    @elseif (auth()->user()->role == 0)
        @include('pages.student.home')
    @endif
@endif

