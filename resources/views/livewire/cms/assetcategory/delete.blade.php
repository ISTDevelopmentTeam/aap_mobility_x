<?php

use Livewire\Volt\Component;
use App\Models\AssetCategory;
use Livewire\Attributes\On;

new class extends Component {
    public $id;

    #[On('show-delete-toast')]
    public function destroy($id)
    {
        $this->id = $id;
        $category = AssetCategory::findOrFail($id);
        $category->delete();

        $this->dispatch('refresh-list');
        $this->dispatch('showDeleteToast');
    }

    #[On('restore')]
    public function restore()
    {
        $category = AssetCategory::withTrashed()->findOrFail($this->id);
        $category->restore();
        $this->dispatch('refresh-list');
    }
}; ?>

<div>
    <livewire:components.toast.delete />
</div>
