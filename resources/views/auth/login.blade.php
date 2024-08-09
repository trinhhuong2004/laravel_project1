@extends('layouts.auth')

@section('title')
    Login
@endsection
@section('content')

    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Welcome to IN+</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Login in. To see it in action.</p>
        <form class="m-t" role="form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username" required="" value="{{ old('email') }}" autocomplete="email">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="" value="{{ old('password') }}">
            </div>
            @error('email')
            <p class="text-danger"> {{ $message }} </p>
            @enderror
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="backend/#"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href=" {{ route('register') }}">Create an account</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
@endsection



