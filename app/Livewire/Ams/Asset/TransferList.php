<?php

namespace App\Livewire\Ams\Asset;

use App\Models\Asset;
use Livewire\Component;

class TransferList extends Component
{
    public $showAssetModal = false;
    public $availableAssets = [];
    public $selectedAssets = [];
    public $assigneeName = '';
    public int $originAssetId = 0;
    protected $listeners = [
        'open-transfer-list' => 'open',
        'reset-selected-asset' => 'removeSelectedAsset',
    ];


    public function updatedSelectedAssets(): void
    {
        $this->selectedAssets = collect($this->selectedAssets)
            ->map(fn($v) => (int) $v)->unique()->values()->all();
    }

    public function selectAsset($assetId): void
    {
        if (!in_array($assetId, $this->selectedAssets, true)) {
            $this->selectedAssets[] = $assetId;
        }
    }

    public function removeSelectedAsset(int $id)
    {
        $this->selectedAssets = array_values(
            array_filter($this->selectedAssets, fn($v) => (int) $v !== $id)
        );
    }

    public function resetSelectedAssets()
    {
        $this->selectedAssets = [];
        // dump($this->selectedAssets);
    }

    public function confirmSelectedAssets()
    {
        $this->dispatch(
            'confirm-selected-transfer',
            $this->selectedAssets
        );
    }
    public function open(int $id, array $preselected = []): void
    {
        $this->originAssetId = (int) $id;

        if ($preselected) {
            $this->selectedAssets = collect($preselected)
                ->map(fn($v) => (int) $v)->unique()->values()->all();
        }

        $origin = Asset::with(['department', 'employee'])
            ->select(['asset_id', 'asset_type', 'department_id', 'employee_id'])
            ->findOrFail($this->originAssetId);

        $q = Asset::with(['status', 'brand', 'department', 'employee'])
            ->where('ams_active', 1)
            ->where('asset_id', '!=', $origin->asset_id);

        if ((int) $origin->asset_type === 1 && $origin->department_id) {
            $q->where('asset_type', 1)->where('department_id', $origin->department_id);
            $this->assigneeName = strtoupper($origin->department->department_name);
        } elseif ((int) $origin->asset_type === 2 && $origin->employee_id) {
            $q->where('asset_type', 2)->where('employee_id', $origin->employee_id);
            $this->assigneeName = strtoupper($origin->employee->employee_lastname) . ', ' . strtoupper($origin->employee->employee_firstname);
        }

        $this->availableAssets = $q->orderBy('asset_name')->get();
        $this->showAssetModal = true;
    }


    public function render()
    {
        return view('livewire.ams.asset.transfer-list');
    }
}
