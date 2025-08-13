<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\Brand;

new class extends Component {
    public $brand;
    public $brand_id;

    #[Validate('nullable')]
    public $brand_code;

    #[Validate('required')]
    public $brand_name;

    #[On('show-edit-modal')]
    public function showEditModal($id)
    {
        $this->brand = Brand::findOrFail($id);
        $this->fill($this->brand);
        $this->js('showEditModal');
    }

    public function update()
    {
        $data = $this->validate();
        $this->brand->update($data);

        $this->js('closeEditModal');
        $this->reset();
        $this->dispatch('refresh-list');
    }
}; ?>

<div>
    <x-modal-box name="EditModal">
        <form wire:submit="update">
            <fieldset class="fieldset order-base-300 border rounded-box p-4">
                <legend class="fieldset-legend text-blue-900 text-lg">
                    Edit IT Brand
                </legend>
    
                {{-- Input Fields --}}
                <label class="floating-label">
                    <input wire:model.blur="brand_code" placeholder="Enter Brand Code" class="input input-sm w-96 placeholder:italic" />
                    <span>Brand Code</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('brand_code') {{ $message }} @enderror
                    </p>
                </label>
                <label class="floating-label">
                    <input wire:model.blur="brand_name" placeholder="Enter Brand Name" class="input input-sm w-96 placeholder:italic"/>
                    <span>Brand Name</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('brand_name') {{ $message }} @enderror
                    </p>
                </label>
         
                {{-- Action Buttons --}}
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" x-on:click="$js.closeEditModal" class="btn btn-outline btn-secondary text-gray-700 hover:text-white btn-sm">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        Submit
                    </button>
                </div>
            </fieldset>
        </form>
    </x-modal-box>
</div>
