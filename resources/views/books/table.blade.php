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
                        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
                        <div class="px-0 md:px-10">
                            <div class="flex items-center justify-between">
                                <x-primary-button>
                                    {{ __('Tambah Buku') }}
                                </x-primary-button>
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
                                                            <img src="{{ $book->cover }}" alt="{{ $book->title }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-left pl-5">
                                                    <p class="text-indigo-600 underline font-medium">
                                                        <a target="__blank" href="{{ $book->file }}">Link</a>
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
                                                    <x-secondary-button
                                                        class="bg-blue-600 hover:bg-blue-700 text-white">Edit
                                                    </x-secondary-button>
                                                    <x-danger-button>Hapus</x-danger-button>
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
</x-app-layout>
