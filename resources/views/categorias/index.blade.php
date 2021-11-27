<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <table class="table table-hover">
        <thead>
            <tr>
                <th>Descricao</th>
                <th>-</th>
            </tr>    
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->descricao}}</td>
                    <td>-</td>
                </tr>
            @endforeach    
        </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>