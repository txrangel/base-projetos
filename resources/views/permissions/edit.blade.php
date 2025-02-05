@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section class="mt-4 relative overflow-auto">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Editar Permissão') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Atualize as informações da permissão conforme necessário.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('permission.update', $permissao->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $permissao->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
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