@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #7c3aed;
            --secondary-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #111827;
            --light-color: #1f2937;
            --darker-color: #0f172a;
            --text-light: #f1f5f9;
            --text-muted: #94a3b8;
            --border-color: #374151;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-light);
        }

        .dark-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }

        .dark-card {
            background: rgba(31, 41, 55, 0.95);
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .dark-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
            border-color: var(--primary-color);
        }

        .form-control,
        .form-select {
            background-color: var(--darker-color);
            border: 2px solid var(--border-color);
            color: var(--text-light);
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--darker-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.25);
            color: var(--text-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-label {
            color: var(--text-light);
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4);
        }

        .btn-danger {
            background: linear-gradient(45deg, var(--danger-color), #dc2626);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text-light);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: var(--success-color);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }
    </style>
    <div>
        <div class="dark-bg">
            <div class="py-5">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-12 col-md-8 col-lg-6 mx-auto">
                            <div class="p-4 dark-card">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-6 mx-auto">
                            <div class="p-4 dark-card">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-6 mx-auto">
                            <div class="p-4 dark-card">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
