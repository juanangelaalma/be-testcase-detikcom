<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Kategori Buku') }}
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
                              <a href="{{ route('categories.create') }}">
                                  <x-primary-button>
                                      {{ __('Tambah Kategori') }}
                                  </x-primary-button>
                              </a>
                              {{-- <x-category-filter /> --}}
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
                                              <p class="text-base font-medium">Nama Kategori</p>
                                          </th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php
                                          $no = 1;
                                      @endphp
                                      @foreach ($categories as $category)
                                          <tr tabindex="0"
                                              class="focus:outline-none h-16 border border-gray-100 rounded">
                                              <td class="text-left pl-5">
                                                  <p>{{ $no }}</p>
                                              </td>
                                              <td class="text-left pl-5">
                                                  <p class="text-gray-700 max-w-[160px] truncate capitalize">
                                                      {{ $category->name }}
                                                  </p>
                                              </td>
                                              <td class="text-left pl-5">
                                                  <div class="flex items-center space-x-2">
                                                      <a href="{{ route('categories.edit', $category->id) }}">
                                                          <x-primary-button type="button">Edit</x-primary-button>
                                                      </a>
                                                      <form method="POST"
                                                          action="{{ route('categories.delete', $category->id) }}">
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
              text: "Data buku yang berhubungan dengan kategori ini akan terhapus juga!",
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
