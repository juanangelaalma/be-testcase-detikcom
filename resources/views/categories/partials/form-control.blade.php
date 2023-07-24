<div class="sm:px-0 w-full flex flex-col md:flex-row md:flex-wrap">
  <div class="mb-1 md:mb-2 md:w-1/2 md:px-2">
      <x-input-label for="name" :value="__('Nama Kategori')" />
      <x-text-input id="name" value="{{ old('name') ? old('name') : $category->name }}" class="block mt-1 w-full"
          type="text" name="name" required autocomplete="current-name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
  </div>
  <div class="w-full md:px-2 md:w-1/2 flex items-center">
      <x-primary-button type="submit" class="mt-4 w-full md:w-1/2 text-center flex justify-center py-3 flex-shrink-0">
          {{ $submitLabel }}
      </x-primary-button>
  </div>
</div>
