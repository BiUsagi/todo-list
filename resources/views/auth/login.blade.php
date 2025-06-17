@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="mb-4 text-center">Đăng nhập</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <label class="form-check-label">Ghi nhớ đăng nhập</label>
                    </div>

                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                </form>
                <hr>
                <div class="mb-3 text-center mt-4">
                    <a href="{{ route('auth.google') }}" class="btn btn-danger w-50">
                        <i class="bi bi-google"></i> Đăng nhập với Google
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
