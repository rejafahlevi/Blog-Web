<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:px-8">
            <form action="{{ route('birdy.update', $birds->id) }}" class="form-control" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea class="@error('content') textarea-error @enderror textarea textarea-bordered w-full" cols="30" id="" name="content" rows="3">
                    {{ $birds->content}}
                    </textarea>
                    @error('content')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex">
                <div class="mb-3">
                    <input class="btn btn-outline" type="submit" value="Save">
                </div>
                <div class="mb-3 ml-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline">Cancel</a>
                </div>
                </div>
            </form>
        </div>
</x-app-layout>