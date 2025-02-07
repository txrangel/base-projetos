@extends('layouts.app')

@section('content')
    <div class="space-y-4">
        <div class="p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg space-y-4">
            <section class="relative overflow-auto">
                @include('user.profile.partials.update-profile-information-form')
            </section>
        </div>
        <div class="p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg space-y-4">
            <section class="relative overflow-auto">
                @include('user.profile.partials.update-password-form')
            </section>
        </div>
    </div>
@endsection