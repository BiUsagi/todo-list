<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
