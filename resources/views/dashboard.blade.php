<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success')}}</div>
            @endif
            @if (session('error'))
            <div class="alert alert-success mb-4">{{ session('error')}}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-gray-400 mb-2">
                    <form action="/birds" class="form-control" method="post">
                        @csrf
                        <textarea class=" @error('content') textarea-error @enderror textarea textarea-primary mb-2" cols="30" id="" name="content" placeholder="Whats in your mind...." rows="3"></textarea>
                        @error('content')
                        <span>{{ $message }}</span>
                        @enderror
                        <input class="btn btn-outline" type="submit" value="Birds">
                    </form>
                </div>

                <div class="p-6 bg-white text-gray-400 mt-4 flex flex-col space-y-2 sm:rounded-lg">
                    @foreach ($birds as $b )
                    <div class="card bg-base-100">
                        <div class="card-body">
                            <h3>{{$b->user->name}}</h3>
                            <p>{{$b->content}}</p>
                        </div>
                        <div class="card-actions p-7">
                            <a href="{{ route('birdy.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('birdy.destroy', $b->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-error btn-sm" value="Delete">
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>