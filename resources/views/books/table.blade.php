<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-5 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="sm:px-0 w-full">
                        <div class="px-0 md:px-10">
                            <x-success-alert />
                            <div class="flex mt-4 items-center justify-between">
                                <div class="flex space-x-0 md:space-x-2 flex-col md:flex-row space-y-2 md:space-y-0">
                                    <a href="{{ route('books.create') }}">
                                        <x-primary-button>
                                            {{ __('Tambah Buku') }}
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('books.export') }}" method="POST">
                                        @csrf
                                        <x-primary-button type="submit" class="bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-600 focus:ring-emerald-500 focus:bg-emerald-600">
                                            {{ __('Export') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                                <x-category-filter />
                            </div>
                        </div>
                        <div class="bg-white px-0 md:px-8 xl:px-10">
                            <div class="mt-7 overflow-x-auto">
                                <table class="w-full whitespace-nowrap">
                                    <thead>
                                        <tr tabindex="0"
                                            class="focus:outline-none w-full h-16 border border-gray-100 rounded">
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">#</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">Cover</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">File</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">Judul</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">Kategori</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">Deskripsi</p>
                                            </th>
                                            <th class="text-left pl-5">
                                                <p class="text-base font-medium">Jumlah</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($books as $book)
                                            <tr tabindex="0"
                                                class="focus:outline-none h-16 border border-gray-100 rounded">
                                                <td class="text-left pl-5">
                                                    <p>{{ $no }}</p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <div class="flex justify-center items-center">
                                                        <div
                                                            class="h-10 w-6 overflow-hidden object-cover object-center">
                                                            <img src="{{ str_starts_with($book->cover, 'http') ? $book->cover : asset('storage' . $book->cover) }}"
                                                                alt="{{ $book->title }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-indigo-600 underline font-medium">
                                                        <a target="__blank" href="{{ str_starts_with($book->file, 'http') ? $book->file : asset('storage' . $book->file) }}">Link</a>
                                                    </p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-gray-700 max-w-[160px] truncate">
                                                        {{ $book->title }}
                                                    </p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-gray-700 capitalize">
                                                        {{ $book->category->name }}
                                                    </p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-gray-700 max-w-[160px] truncate">
                                                        {{ $book->description }}
                                                    </p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-gray-700">
                                                        {{ $book->quantity }}
                                                    </p>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <div class="flex items-center space-x-2">
                                                        <a href="{{ route('books.edit', $book->id) }}">
                                                            <x-primary-button type="button">Edit</x-primary-button>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('books.delete', $book->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <x-danger-button class="show_confirm" type="submit">Hapus
                                                            </x-danger-button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $no++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showConfirm(event) {
            event.preventDefault();

            const form = event.target.closest('form');
            const name = event.target.dataset.name;

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan terhapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Mengaitkan event click pada tombol dengan class 'show_confirm' ke fungsi showConfirm
        document.querySelectorAll('.show_confirm').forEach(button => {
            button.addEventListener('click', showConfirm);
        });
    </script>
</x-app-layout>
