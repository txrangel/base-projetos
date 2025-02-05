@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section class="mt-4 relative overflow-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Editar Permissões do Perfil: ') }} {{ $profile->name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Selecione as permissões que deseja atrelar ao profile.') }}
                        </p>
                    </header>

                    <form action="{{ route('profiles.permissions.update', $profile->id) }}" method="POST" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="permissions" class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-5 font-medium text-gray-900">Selecione as Permissões:</label>
                            <ul class="grid w-full gap-2 md:grid-cols-3">
                                @foreach ($permissions as $permission)
                                    <li>
                                        <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]"
                                            value="{{ $permission->id }}" class="hidden peer"
                                            {{ $profile->permissions->contains($permission->id) ? 'checked' : '' }}>
                                        <label for="permission_{{ $permission->id }}"
                                            class="inline-flex justify-between w-full h-12 p-2 overflow-hidden shadow-md text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                            <div class="block">
                                                <div class="w-full text-md font-semibold line-clamp-3 text-gray-700 break-words">{{ $permission->name }}</div>
                                            </div>
                                        </label>
                                        <x-input-error class="mt-2" :messages="$errors->get('permissions.*')" />
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
@endsection