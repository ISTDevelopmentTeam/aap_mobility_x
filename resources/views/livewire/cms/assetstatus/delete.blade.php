<?php

use Livewire\Volt\Component;
use App\Models\AssetStatus;
use Livewire\Attributes\On;

new class extends Component {
    public $id;

    #[On('show-delete-toast')]
    public function destroy($id)
    {
        $this->id = $id;
        $status = AssetStatus::findOrFail($id);
        $status->delete();

        $this->dispatch('refresh-list');
        $this->dispatch('showDeleteToast');
    }

    #[On('restore')]
    public function restore()
    {
        $status = AssetStatus::withTrashed()->findOrFail($this->id);
        $status->restore();
        $this->dispatch('refresh-list');
    }
}; ?>

<div>
    <livewire:components.toast.delete />
</div>
