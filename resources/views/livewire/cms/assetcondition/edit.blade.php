<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\AssetCondition;

new class extends Component {
    public $condition;
    public $condition_id;

    #[Validate('required')]
    public $condition_name;

    #[Validate('nullable')]
    public $condition_description;

    #[On('show-edit-modal')]
    public function showEditModal($id)
    {
        $this->condition = AssetCondition::findOrFail($id);
        $this->fill($this->condition);
        $this->js('showEditModal');
    }

    public function update()
    {
        $data = $this->validate();
        $this->condition->update($data);

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
                    Edit Asset Condition
                </legend>
    
                {{-- Input Fields --}}
                <label class="floating-label">
                    <input wire:model.blur="condition_name" placeholder="Enter Asset Condition Name" class="input input-sm w-96 placeholder:italic"/>
                    <span>Asset Condition Name</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('condition_name') {{ $message }} @enderror
                    </p>
                </label>
                <label class="floating-label">
                    <input wire:model.blur="condition_description" placeholder="Enter Asset Condition Description" class="input input-sm w-96 placeholder:italic" />
                    <span>Asset Condition Description</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('condition_description') {{ $message }} @enderror
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
