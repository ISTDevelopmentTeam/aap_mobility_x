<?php

namespace App\Livewire\Ams\Asset;

use App\Models\Asset;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Transfer;
use App\Models\Department;

class TransferForm extends Component
{
    public $assetId;
    public $asset;

    // Search-related
    public $searchTerm = '';
    public $filteredDepartments = [];
    public $filteredEmployees = [];
    public $assets = [];

    public $transfer_date;
    public $control_number;
    public $from_department_id;
    public $from_department_name;
    public $from_employee_id;
    public $from_employee_name;
    public $to_department_id;
    public $to_department_name;
    public $to_employee_id;
    public $to_employee_name;
    public $transfer_reason;
    public $showConfirmModal = false;
    protected $listeners = ['confirm-selected-transfer' => 'addSelectedAssets'];

    public function confirmSubmit()
    {
        $this->showConfirmModal = true;
    }

    public function submitConfirmed()
    {
        $this->submit(); // your existing submit() logic
    }

    public function openAssetPicker(): void
    {
        $origin = (int) collect($this->assets)
            ->map(fn($a) => (int) ($a['asset_id'] ?? $a->asset_id ?? 0))
            ->first();

        if ($origin === 0)
            return; 

        $preselected = collect($this->assets)
            ->map(fn($a) => (int) ($a['asset_id'] ?? $a->asset_id ?? 0))
            ->reject(fn(int $id) => $id === $origin)
            ->unique()->values()->all();

        $this->dispatch('open-transfer-list', id: $origin, preselected: $preselected);
    }

    public function addSelectedAssets($selectedAssets)
    {
        // dump($selectedAssets);
        // Ensure it's an array
        if (!is_array($selectedAssets)) {
            return;
        }

        // Get current asset IDs already in the $assets collection/array
        $existingIds = collect($this->assets)->pluck('asset_id')->toArray();

        // Fetch new assets from DB
        $newAssets = Asset::with(['category', 'employee', 'department', 'brand'])
            ->whereIn('asset_id', $selectedAssets)
            ->whereNotIn('asset_id', $existingIds)
            ->get();

        // Merge into the $assets property
        if ($this->assets instanceof \Illuminate\Support\Collection) {
            $this->assets = $this->assets->merge($newAssets);
        } else {
            $this->assets = collect($this->assets)->merge($newAssets);
        }
    }


    public function viewDetails($id)
    {
        $this->dispatch(
            'open-transfer-view',
            $id
        );
    }

    public function removeAsset(int $assetId): void
    {
        $this->assets = collect($this->assets)
            ->reject(fn($asset) => (int) ($asset['asset_id'] ?? $asset->asset_id) === $assetId)
            ->values();
        $this->dispatch('reset-selected-asset', $assetId);
    }

    public function mount()
    {
        $this->asset = Asset::with(['category', 'employee', 'department', 'brand'])
            ->findOrFail($this->assetId);

        $this->filteredDepartments = Department::all();
        $this->filteredEmployees = Employee::all();
        $this->transfer_date = now()->format('Y-m-d'); // Sets default to today
        $this->from_department_id = $this->asset->department?->department_id;
        $this->from_employee_id = $this->asset->employee?->employee_id;

        $this->assets = collect([$this->asset]);
    }

    public function updatedSearchTerm()
    {
        if ($this->asset->asset_type === '1') {
            $this->filteredDepartments = Department::where('department_name', 'like', '%' . $this->searchTerm . '%')->get();
        } elseif ($this->asset->asset_type === '2') {
            $this->filteredEmployees = Employee::where(function ($query) {
                $query->where('employee_firstname', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('employee_lastname', 'like', '%' . $this->searchTerm . '%');
            })->get();
        }
    }

    public function submit()
    {
        // Ensure asset exists
        $asset = Asset::findOrFail($this->assetId);

        // Sanitize and uppercase all string-based inputs
        $controlNumber = strtoupper($this->control_number);
        $reason = strtoupper($this->transfer_reason);
        $transferDate = $this->transfer_date;

        // Create new transfer record
        Transfer::create([
            'asset_id' => $asset->asset_id,
            'from_department_id' => $this->from_department_id,
            'from_employee_id' => $this->from_employee_id,
            'to_department_id' => $this->to_department_id,
            'to_employee_id' => $this->to_employee_id,
            'transfer_date' => $transferDate,
            'control_number' => $controlNumber,
            'reason' => $reason,
        ]);

        // Update the asset's ownership
        if ($this->to_department_id) {
            $asset->department_id = $this->to_department_id;
            $asset->employee_id = null;
        }

        if ($this->to_employee_id) {
            $asset->employee_id = $this->to_employee_id;
            $asset->department_id = null;
            $asset->status_id = 2;
        }

        $asset->save();
        $this->dispatch('show-transfer-success-modal');
    }


    public function render()
    {
        return view('livewire.ams.asset.transfer-form', [
            'categories' => \App\Models\AssetCategory::all(),
            'conditions' => \App\Models\AssetCondition::all(),
            'statuses' => \App\Models\AssetStatus::all(),
            'brands' => \App\Models\Brand::all(),
            'departments' => $this->filteredDepartments,
            'employees' => $this->filteredEmployees,
        ]);
    }
}
