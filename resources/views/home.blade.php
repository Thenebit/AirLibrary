@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (auth()->check())
                        @if (auth()->user()->role == 0)
                            @include('pages.student.home')
                        @elseif (auth()->user()->role == 1)
                            @include('pages.admin.home')
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
