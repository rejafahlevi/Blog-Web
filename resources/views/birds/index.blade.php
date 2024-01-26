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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-900">{{ $b->user->name }}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $b->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($b->created_at->eq($b->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $b->content }}</p>
                </div>
                @can('access', \App\Http\Controllers\AdminController::class)
                <div class="card-actions p-4">
                    <a href="{{ route('birdy.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('birdy.destroy', $b->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-error btn-sm" value="Delete">
                    </form>
                </div>
                @else
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
                @endcan
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
        document.addEventListener('DOMContentLoaded', function () {
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