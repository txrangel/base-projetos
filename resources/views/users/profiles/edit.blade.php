@extends('layouts.app')
@section('content')
    @can('manageProfiles', $user)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section class="mt-4 relative overflow-auto">
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
                                                <input type="checkbox" id="permission_{{ $profile->id }}" name="profiles[]"
                                                    value="{{ $profile->id }}" class="hidden peer"
                                                    {{ $user->profiles->contains($profile->id) ? 'checked' : '' }}>
                                                <label for="permission_{{ $profile->id }}"
                                                    class="inline-flex justify-between w-full h-12 p-2 overflow-hidden shadow-md text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                                    <div class="block">
                                                        <div class="w-full text-md font-semibold line-clamp-3 text-gray-700 break-words">{{ $profile->name }}</div>
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
                </div>
            </div>
        </div>
    @endcan
@endsection
