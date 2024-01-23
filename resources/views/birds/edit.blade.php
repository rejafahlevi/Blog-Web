<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:p-8 sm:rounded-lg">
            <form action="{{ route('birdy.update', $bird->id) }}" class="form-control" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea class="@error('content') textarea-error @enderror textarea textarea-bordered w-full" cols="30" id="" name="content" rows="3">
                    {{ $bird->content}}
                    </textarea>
                    @error('content')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input class="btn btn-outline btn-success" type="submit" value="Edit">
                </div>
            </form>
        </div>
    </div>
</x-app-layout>