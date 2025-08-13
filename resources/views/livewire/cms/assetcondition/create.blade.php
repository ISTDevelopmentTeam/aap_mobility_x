<?php

use Livewire\Volt\Component;
use App\Models\AssetCondition;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required')]
    public $condition_name;

    #[Validate('nullable')]
    public $condition_description;

    public bool $isCreatingAnother = false;

    public function store()
    {
        $data = $this->validate();
        AssetCondition::create($data);

        if(!$this->isCreatingAnother) {
            $this->js('closeCreateModal');
        }

        $this->reset(['condition_description', 'condition_name']);
        $this->dispatch('refresh-list');
    }
}; ?>


<div>
    <button x-on:click="$js.showCreateModal" class="btn btn-primary">
        Add Asset Condition
    </button>

    <x-modal-box name="CreateModal">
        <form wire:submit.prevent="store" x-data="{ isChecked: false }">
            <fieldset class="fieldset border-base-300 border rounded-box p-4">
                <legend class="fieldset-legend text-blue-900 text-lg">
                    Add Asset Condition
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
                <div class="flex mt-2" x-bind:class="isChecked ? 'justify-between' : 'justify-end'" >
                    <button type="submit" wire:show="isCreatingAnother" x-on:click="$js.closeCreateModal" class="btn btn-ghost btn-sm">
                            Submit and Close
                    </button>
                    <div class="flex justify-end gap-2">
                        <button type="button" x-on:click="$js.closeCreateModal" class="btn btn-outline btn-secondary text-gray-700 hover:text-white btn-sm">
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="btn btn-primary btn-sm"
                        >
                            Submit
                        </button>
                    <div>
                </div>
            </fieldset>
            <div class="mt-3">
                <label class="label text-xs">
                    <input wire:model="isCreatingAnother" x-model="isChecked" type="checkbox" class="w-4 h-4 text-blue-900 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    Submit and create another
                </label>
            </div>
        </form>
    </x-modal-box>
</div>
