<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Birdy') }}
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

                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    @foreach ($birds as $b )
                    <div class="p-6 flex space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $b->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $b->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                            <p class="mt-4 text-lg text-gray-900">{{ $b->content }}</p>
                        </div>
                        @if ($b->user->is(auth()->user()))
                        <div class="card-actions p-4">
                            <a href="{{ route('birdy.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('birdy.destroy', $b->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-error btn-sm" value="Delete">
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</x-app-layout>