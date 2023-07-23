<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-5 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:px-0 w-full flex flex-col md:flex-row md:flex-wrap">
                            <div class="mb-2 md:w-1/2 md:px-2">
                                <x-input-label for="title" :value="__('Judul Buku')" />
                                <x-text-input id="title" value="{{ old('title') }}" class="block mt-1 w-full" type="text" name="title"
                                    required autocomplete="current-title" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="mb-2 md:w-1/2 md:px-2">
                                <x-input-label for="category" :value="__('Kategori')" />
                                <x-select-input id="category" name="category" class="mt-1 w-full capitalize">
                                    <x-option-select selected>Pilih...</x-option-select>
                                    @foreach ($categories as $category)
                                        <option class="capitalize" value="{{ $category->id }}" {{ $category->id == old('category') ? 'selected' : '' }} class="capitalize">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                            <div class="mb-2 md:w-1/2 md:px-2">
                                <x-input-label for="description" :value="__('Deskripsi')" />
                                <x-textarea-input id="description" name="description" class="w-full mt-1" cols="20"
                                    rows="4">
                                    {{ old('title') }}
                                </x-textarea-input>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="mb-2 md:w-1/2 md:px-2">
                                <x-input-label for="quantity" :value="__('Jumlah')" />
                                <x-text-input id="quantity" value="{{ old('quantity') }}" class="block mt-1 w-full" type="number" name="quantity"
                                    required autocomplete="current-quantity" />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                <div class="mb-2 w-full mt-2">
                                    <x-input-label for="cover" :value="__('Cover')" />
                                    <x-file-input id="cover" accept="image/jpeg,image/jpg,image/gif,image/png" value="{{ old('cover') }}" name="cover"></x-file-input>
                                    <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                                </div>
                            </div>
                            <div class="mb-2 md:w-1/2 md:px-2">
                                <x-input-label for="file" :value="__('File')" />
                                <x-file-input id="file" accept="application/pdf" value="{{ old('file') }}" name="file"></x-file-input>
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>
                            <div class="w-full md:px-2 md:w-1/2">
                                <x-primary-button type="submit" class="mt-4 w-full text-center flex justify-center py-3">Tambah
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
