@extends('web.components.layout')

@section('title', 'Login')

@push('styles')
@endpush

@section('main')
    @include('web/components/session')

    <main class="form-signin">
        <form action="{{ url('login') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="account" placeholder="">
                <label for="floatingInput">Account</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" maxlength="32">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
    </main>
@endsection
