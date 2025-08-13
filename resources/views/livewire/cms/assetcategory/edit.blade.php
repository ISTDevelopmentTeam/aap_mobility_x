<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\AssetCategory;

new class extends Component {
    public $category;
    public $category_id;

    #[Validate('required')]
    public $category_name;

    #[Validate('nullable')]
    public $category_description;

    #[On('show-edit-modal')]
    public function showEditModal($id)
    {
        $this->category = AssetCategory::findOrFail($id);
        $this->fill($this->category);
        $this->js('showEditModal');
    }

    public function update()
    {
        $data = $this->validate();
        $this->category->update($data);

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
                    Edit Asset Category
                </legend>
    
                {{-- Input Fields --}}
                <label class="floating-label">
                    <input wire:model.blur="category_name" placeholder="Enter Asset Category Name" class="input input-sm w-96 placeholder:italic"/>
                    <span>Asset Category Name</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('category_name') {{ $message }} @enderror
                    </p>
                </label>
                <label class="floating-label">
                    <input wire:model.blur="category_description" placeholder="Enter Asset Category Description" class="input input-sm w-96 placeholder:italic" />
                    <span>Asset Category Description</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('category_description') {{ $message }} @enderror
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
