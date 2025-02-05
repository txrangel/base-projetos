@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="space-x-4">
                    <a href="{{ route('profiles.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center my-8 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Novo Perfil') }}
                    </a>
                </div>
                <section class="mt-4 relative overflow-auto">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">
                        {{ __('Lista de Perfis') }}
                    </h2>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 tracking-wider">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col" class="px-6 py-3 tracking-wider">
                                    {{ __('Nome') }}
                                </th>
                                <th scope="col" class="px-6 py-3 tracking-wider flex justify-center">
                                    {{ __('Ações') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perfis as $perfil)
                                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-50 dark:bg-gray-800' : 'bg-white dark:bg-gray-900' }} border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $perfil->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $perfil->name }}
                                    </td>
                                    <td class="px-6 py-4 flex justify-center space-x-4">
                                        <a href="{{ route('profiles.edit', $perfil->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">
                                            {{ __('Editar') }}
                                        </a>
                                        <button onclick="openDeleteModal('Você tem certeza que deseja excluir o perfil: {{ $perfil->name }}?', '{{ route('profiles.destroy', $perfil->id) }}')"
                                                class="text-red-600 dark:text-red-500 hover:underline">
                                            {{ __('Excluir') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <!-- Adicione a paginação aqui -->
                <div class="mt-4">
                    {{ $perfis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
@include('components.delete-modal')
@endsection