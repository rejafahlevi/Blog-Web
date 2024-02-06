<x-app-layout>
    @if ($bird)
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex space-x-2">
                <a href="{{ url()->previous() }}" class="flex space-x-6 btn btn-square btn-outline btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
            </div>
            <div class="flex-1">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                    {{ $bird->user->name }}'s Birdy
                </h2>
            </div>
        </div>
    </x-slot>
    @else
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Birdy not found
        </h2>
    </x-slot>
    @endif

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:px-8">
        @if (session('success'))
        <div class="alert alert-success mb-4" id="success-message">{{ session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-success mb-4" id="error-message">{{ session('error')}}</div>
        @endif
        <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div class="p-6 flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-900">{{ $bird->user->name }}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $bird->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($bird->created_at->eq($bird->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $bird->content }}</p>
                    <div class="p-2 bg-white shadow-sm rounded-lg text-gray-900 mb-2">
                        <form action="{{ route('comments.store') }}" class="form-control" method="POST">
                            @csrf
                            <input type="hidden" name="birdies_id" value="{{ $bird->id }}">
                            <div class="flex">
                                <textarea class=" @error('body') textarea-error @enderror textarea textarea-neutral textarea-xs w-full max-w-xs mb-2" id="" name="body" placeholder="Any Thought ?...." rows="1"></textarea>
                                @error('body')
                                <span>{{ $message }}</span>
                                @enderror
                                <button class="btn btn-square btn-outline btn-xs mt-6 ml-2 p-1" type="submit" value="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @can('access', \App\Http\Controllers\AdminController::class)
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <x-dropdown-link href="{{ route('birdy.edit', $bird->id) }}" class="btn btn-warning btn-sm">Edit</x-dropdown-link>
                            </li>
                            <li>
                                <form action="{{ route('birdy.destroy', $bird->id) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </x-slot>
                </x-dropdown>
                @else
                @if ($bird->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="card-actions p-4">
                            <a href="{{ route('birdy.edit', $bird->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('birdy.destroy', $bird->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-error btn-sm" value="Delete">
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endif
                @endcan
            </div>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                @foreach ($comments as $comment)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="font-semibold mr-2">{{ $comment->user->name }}:</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $comment->body }}</p>
                        <div class="card-action p-2">
                            @if ($comment->user->id == auth()->id())
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-square btn-xs btn-outline btn-error mt-2" type="submit" value="delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <script>
                // Fungsi untuk menyembunyikan pesan setelah beberapa detik
                function hideMessage() {
                    var successMessage = document.getElementById('success-message');
                    var errorMessage = document.getElementById('error-message');

                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }

                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                }

                // Panggil fungsi hideMessage() setelah 3000 milidetik (3 detik)
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(hideMessage, 3000);
                });
            </script>
</x-app-layout>