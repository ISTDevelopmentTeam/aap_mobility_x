<?php

use Livewire\Volt\Component;
use App\Models\AssetCondition;
use Livewire\Attributes\On;

new class extends Component {
    public $id;

    #[On('show-delete-toast')]
    public function destroy($id)
    {
        $this->id = $id;
        $condition = AssetCondition::findOrFail($id);
        $condition->delete();

        $this->dispatch('refresh-list');
        $this->dispatch('showDeleteToast');
    }

    #[On('restore')]
    public function restore()
    {
        $condition = AssetCondition::withTrashed()->findOrFail($this->id);
        $condition->restore();
        $this->dispatch('refresh-list');
    }
}; ?>

<div>
    <livewire:components.toast.delete />
</div>
