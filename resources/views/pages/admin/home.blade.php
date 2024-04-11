@extends('layouts.app1')

@section('content')

<div class="container-scroller">

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <!-- <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('admin/assets/images/logo.svg') }}" alt="logo" /></a> -->
          <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('admin/assets/images/logo-mini.svg') }}" alt="logo" /></a> -->
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
           @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{ asset('admin/assets/images/faces/prl.webp') }}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"> {{ Auth::user()->name }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout me-2 text-primary"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
              </div>
            </li>
           @endguest
          </ul>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ asset('admin/assets/images/faces/prl.webp') }}" alt="profile">
                  <span class="login-status online"></span>

                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                  <span class="text-secondary text-small">Platform Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/home') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ url('publish') }}">
                <span class="menu-title">Book Publish</span>
                <i class="mdi mdi-book-multiple menu-icon"></i>
              </a>
            </li>

          </ul>
        </nav>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                  <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                      <i class="mdi mdi-home"></i>
                    </span> Dashboard
                  </h3>
                </div>
                <div class="row">
                  <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Students <i class="mdi mdi-account-circle mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalLoggedInUsers }}</h2>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                      <div class="card-body">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Books <i class="mdi mdi-book-multiple mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $allBooks }}</h2>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">List of Books</h4>

                          </p>
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th> ID </th>
                                <th> Title </th>
                                <th> Author</th>
                                <th> Category </th>
                                <th> Upload Date </th>
                                <th> Actions </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $docs)
                                    <tr>
                                      <td>{{ $docs->id }}</td>
                                      <td> {{ $docs->title }} </td>
                                      <td> {{ $docs->author }} </td>
                                      <td> {{ $docs->category }} </td>
                                      <td> {{ $docs->created_at->format('M jS Y') }}</td>
                                      <td>
                                        <a href="{{ url('/delete', $docs->id) }}" class="btn btn-danger">Delete</a>
                                        <a href="{{ url('/view', $docs->id) }}" class="btn btn-primary">Read</a>
                                      </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>

            </div>

            </div>
            <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © AirLibrary 2024</span>
            </div>
          </footer>
        </div>
    </div>
</div>

@endsection
