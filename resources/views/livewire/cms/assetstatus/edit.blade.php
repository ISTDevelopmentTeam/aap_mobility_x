<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\AssetStatus;

new class extends Component {
    public $status;
    public $status_id;

    #[Validate('required')]
    public $status_name;

    #[Validate('required')]
    public $status_description;

    #[On('show-edit-modal')]
    public function showEditModal($id)
    {
        $this->status = AssetStatus::findOrFail($id);
        $this->fill($this->status);
        $this->js('showEditModal');
    }

    public function update()
    {
        $data = $this->validate();
        $this->status->update($data);

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
                    Edit Asset Status
                </legend>
    
                {{-- Input Fields --}}
                <label class="floating-label">
                    <input wire:model.blur="status_name" placeholder="Enter Asset Status Name" class="input input-sm w-96 placeholder:italic"/>
                    <span>Asset Status Name</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('status_name') {{ $message }} @enderror
                    </p>
                </label>
                <label class="floating-label">
                    <input wire:model.blur="status_description" placeholder="Enter Asset Status Description" class="input input-sm w-96 placeholder:italic" />
                    <span>Asset Status Description</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('status_description') {{ $message }} @enderror
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
