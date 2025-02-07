@extends('layouts.app')
@section('content')
    @can('update', $permission)
        <div class="p-8 bg-gray-100 dark:bg-gray-800 shadow sm:rounded-lg space-y-4">
            <section class="relative overflow-auto">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Editar Permissão') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Atualize as informações da permissão conforme necessário.') }}
                    </p>
                </header>
                <form method="post" action="{{ route('permissions.update', $permission->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $permission->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    @endcan
@endsection