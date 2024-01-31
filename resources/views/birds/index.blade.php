<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Birdy') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:px-8">
        @if (session('success'))
        <div class="alert alert-success mb-4" id="success-message">{{ session('success')}}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-success mb-4" id="error-message">{{ session('error')}}</div>
        @endif
        <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($birds as $b )
            <div class="p-6 flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>

                <a href="{{ route('birdy.show', $b->id) }}" class="flex-1 rounded-md transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-900">{{ $b->user->name }}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $b->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($b->created_at->eq($b->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                    </div>
                    <p class="mt-6 text-lg text-gray-900">{{ $b->content }}</p>
                    <div class="flex space-x-2 mt-4 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                        <div class="text-gray-600 text-sm">
                            {{ $b->comments->count() }} comments
                        </div>
                    </div>
                </a>
                <!-- Birdy Section -->
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
                                <x-dropdown-link href="{{ route('birdy.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</x-dropdown-link>
                            </li>
                            <li>
                                <form action="{{ route('birdy.destroy', $b->id) }}" method="post">
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
                @if ($b->user->is(auth()->user()))
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
                            <a href="{{ route('birdy.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('birdy.destroy', $b->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-error btn-sm" value="Delete">
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
                @endif
                @endcan
                <!-- Comment -->
            </div>
            @endforeach
        </div>
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

<!-- 
    membuat table baru untuk comment,
    relasi tabel comment adalah id user dan id birdies
    like di tabel birdies,
    like tidak menampilkan user berarti tipe integer

    tabel admin isinya :
    nama user
    role user
    postingan int all
    like int all

    nampilkan detail data :
    Nama
    Email
    Postingan -> detail berupa content coment dan like

    Menampilkan chart user di role admin
-->