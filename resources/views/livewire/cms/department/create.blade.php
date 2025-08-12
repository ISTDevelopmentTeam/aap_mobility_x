<?php

use Livewire\Volt\Component;
use App\Models\Department;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('nullable')]
    public $department_code;

    #[Validate('required')]
    public $department_name;

    public bool $isCreatingAnother = false;

    public function store()
    {
        $data = $this->validate();
        Department::create($data);

        if(!$this->isCreatingAnother) {
            $this->js('closeCreateModal');
        }

        $this->reset(['department_code', 'department_name']);
        $this->dispatch('refresh-list');
    }
}; ?>


<div>
    <button x-on:click="$js.showCreateModal" class="btn btn-primary">
        Add Department
    </button>

    <x-modal-box name="CreateModal">
        <form wire:submit.prevent="store" x-data="{ isChecked: false }">
            <fieldset class="fieldset border-base-300 border rounded-box p-4">
                <legend class="fieldset-legend text-blue-900 text-lg">
                    Add Department
                </legend>
    
                {{-- Input Fields --}}
                <label class="floating-label">
                    <input wire:model.blur="department_code" placeholder="Enter Department Code" class="input input-sm w-96 placeholder:italic" />
                    <span>Department Code</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('department_code') {{ $message }} @enderror
                    </p>
                </label>
                <label class="floating-label">
                    <input wire:model.blur="department_name" placeholder="Enter Department Name" class="input input-sm w-96 placeholder:italic"/>
                    <span>Department Name</span>
                    <p class="text-error text-xs mt-1"> 
                        @error('department_name') {{ $message }} @enderror
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
