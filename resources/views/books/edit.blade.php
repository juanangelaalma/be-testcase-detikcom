<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-5 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        @include('books.partials.form-control')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
