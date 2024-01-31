<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Hello Admin!") }}
                </div>
                <div class="p-6 text-gray-900">
                    {{ __("Berikut data user birdy") }}
                </div>
                <div class="overflow-x-auto ml-6 mr-6">
                    <table class="table table-xs">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Jumlah Postingan</th>
                                <th>Jumlah Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr class="text-center hover">
                                <th>{{$d ->id}}</th>
                                <td>{{$d ->name}}</td>
                                <td>{{$d ->role}}</td>
                                <td>{{$d -> birds -> count()}}</td>
                                <td>{{$d -> total_comment}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>