<?php

use Livewire\Volt\Component;
use App\Models\Brand;
use Livewire\Attributes\On;

new class extends Component {
    public $id;

    #[On('show-delete-toast')]
    public function destroy($id)
    {
        $this->id = $id;
        $brand = Brand::findOrFail($id);
        $brand->delete();

        $this->dispatch('refresh-list');
        $this->dispatch('showDeleteToast');
    }

    #[On('restore')]
    public function restore()
    {
        $brand = Brand::withTrashed()->findOrFail($this->id);
        $brand->restore();
        $this->dispatch('refresh-list');
    }
}; ?>

<div>
    <livewire:components.toast.delete />
</div>
