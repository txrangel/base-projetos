@extends('layouts.app')
@section('content')
    @can('manageProfiles', $user)
        <div class="p-4 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg space-y-2">
            <section class="relative overflow-auto">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Editar Perfis do Usuário: ') }} {{ $user->name }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Selecione os profiles que deseja atrelar ao usuário.') }}
                    </p>
                </header>
                <form action="{{ route('users.profiles.update', $user->id) }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <label for="profiles" class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5 font-medium text-gray-900">Selecione as Permissões:</label>
                        <ul class="grid w-full gap-2 md:grid-cols-3">
                            @foreach ($profiles as $profile)
                                <li>
                                    <input type="checkbox" id="profile_{{ $profile->id }}" name="profiles[]"
                                        value="{{ $profile->id }}" class="hidden peer"
                                        {{ $user->profiles->contains($profile->id) ? 'checked' : '' }}>
                                    <label for="profile_{{ $profile->id }}"
                                        class="select-none transition-all duration-200 ease-in-out flex w-full justify-end h-12 overflow-hidden shadow-md text-gray-900 bg-gray-300 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:bg-blue-700 relative">
                                        <div class="w-5/6 bg-gray-300 flex items-center justify-between p-2 rounded-sm">
                                            <div class="w-full text-md font-semibold line-clamp-3 break-words">{{ $profile->name }}</div>
                                        </div>
                                    </label>
                                    <x-input-error class="mt-2" :messages="$errors->get('profiles.*')" />
                                </li>                                
                            @endforeach
                        </ul>
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    @endcan
@endsection
