<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Brand;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    public $search = '';

    #[On('refresh-list')]
    public function refreshList()
    {
        $this->dispatch('$refresh')->self();
    }

    public function paginationView()
    {
        return 'custom-pagination-links';
    }

    public function with(): array
    {
        $brands = null;

        if($this->search) {
            $brands = Brand::where(function ($query) {
                $query->where('brand_name', 'like', '%' . $this->search . '%')
                      ->orWhere('brand_code', 'like', '%' . $this->search . '%');
            });
        } else {
            $brands = Brand::latest();
        }

        return [ 'brands' => $brands->paginate(6) ];
    }
}; ?>

<div class="rounded-md border-2 border-gray-100 bg-white shadow-lg -mt-4 min-h-[510px]">
    <div class="flex flex-col justify-between">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap items-center gap-x-1 text-blue-900 text-sm px-4 pt-4">
            <a href="/cms" class="hover:underline">CMS</a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd"
                    d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                    clip-rule="evenodd" />
            </svg>
            <a href="/cms/brands" class="hover:underline">
                IT Brands
            </a>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-4 py-3 gap-4">
        <div>
            <h2 class="font-semibold text-md text-blue-900"
                x-text="'Manage IT Brands'"></h2>
            <p class="text-gray-900 text-sm"
                x-text="'Create, update, and delete IT brand details.'">
            </p>
        </div>

        <div class="flex flex-wrap justify-between items-center gap-4 px-0 lg:px-5">
            {{-- Search --}}
            @include('livewire.cms.department.components.search')
            {{-- CREATE an instance of a model --}}
            <livewire:cms.brand.create />
        </div>
    </div>

    <div class="px-5 pb-5" x-transition>
        {{-- READ the instances of a model --}}
        <div>
            <div class="overflow-x-auto mt-2 mb-3 min-h-[330px]">
                <table class="table table-fixed">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr>
                            <th class="w-64 p-1 m-0 text-center">
                                Code
                            </th>
                            <th class="p-1 m-0 text-center">
                                Name
                            </th>
                            <th class="w-32 p-1 m-0 text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr wire:key="{{ $brand->brand_id }}" class="p-0 m-0 text-sm">
                                <td class="p-1 m-0">{{ $brand->brand_code }}</td>
                                <td class="p-1 m-0">{{ $brand->brand_name }}</td>
                                <td class="p-1 m-0">
                                    <div class="flex flex-row justify-center items-center">
                                        <button @click="$dispatch('show-edit-modal', { id: {{ $brand->brand_id }}})" class="btn btn-ghost text-blue-800 px-2 py-0.5">
                                            <x-icon.edit />
                                        </button>
                                        <button @click="$dispatch('show-delete-toast', { id: {{ $brand->brand_id }}})" class="btn btn-ghost text-red-700 px-2 py-0.5">
                                            <x-icon.delete />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $brands->links(data: ['scrollTo' => false, ]) }}
        </div>

        {{-- UPDATE an instance of a model --}}
        <livewire:cms.brand.edit />
        {{-- DELETE an instance of a model --}}
        <livewire:cms.brand.delete />
    </div>
</div>
