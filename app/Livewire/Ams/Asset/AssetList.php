<?php

namespace App\Livewire\Ams\Asset;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetStatus;
use App\Models\AssetCondition;
use App\Models\Department;

class AssetList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $filterCategory = '';
    public $filterStatus = '';
    public $filterCondition = '';
    public $filterDepartment = '';

    protected $updatesQueryString = true;

    public function updating($property)
    {
        // Reset pagination when any filter or search changes
        if (in_array($property, ['search', 'perPage', 'filterCategory', 'filterStatus', 'filterCondition', 'filterDepartment'])) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'filterCategory',
            'filterStatus',
            'filterCondition',
            'filterDepartment',
        ]);
        $this->resetPage();
    }


    public function render()
    {
        $assets = Asset::with(['employee', 'category', 'status', 'condition', 'department', 'brand'])
            ->where('ams_active', 1)

            ->when(
                $this->filterCategory,
                fn($q) =>
                $q->where('category_id', $this->filterCategory)
            )

            ->when(
                $this->filterStatus,
                fn($q) =>
                $q->where('status_id', $this->filterStatus)
            )

            ->when(
                $this->filterCondition,
                fn($q) =>
                $q->where('condition_id', $this->filterCondition)
            )

            ->when(
                $this->filterDepartment,
                fn($q) =>
                $q->where('department_id', $this->filterDepartment)
            )

            ->when($this->search, function ($query) {
                $term = '%' . $this->search . '%';
                $lowered = strtolower(trim($this->search));

                $query->where(function ($q) use ($term, $lowered) {
                    $q->where('asset_name', 'like', $term)
                        ->orWhere('model_name', 'like', $term)
                        ->orWhere('property_code', 'like', $term)
                        ->orWhere('brand_name_custom', 'like', $term)

                        // Related Brand Name
                        ->orWhereHas('brand', fn($q) =>
                            $q->where('brand_name', 'like', $term))

                        // Related Employee First/Last Name
                        ->orWhereHas('employee', fn($q) =>
                            $q->where('employee_firstname', 'like', $term)
                                ->orWhere('employee_lastname', 'like', $term))

                        // Related Department Name
                        ->orWhereHas('department', fn($q) =>
                            $q->where('department_name', 'like', $term))

                        // Related Category Name
                        ->orWhereHas('category', fn($q) =>
                            $q->where('category_name', 'like', $term))

                        // Related Condition Name
                        ->orWhereHas('condition', fn($q) =>
                            $q->where('condition_name', 'like', $term))

                        // Related Status Name
                        ->orWhereHas('status', fn($q) =>
                            $q->where('status_name', 'like', $term));

                    // "COMMON" → asset_type = 1, "NON-COMMON" → asset_type = 2
                    if ($lowered === 'common') {
                        $q->orWhere('asset_type', 1);
                    } elseif ($lowered === 'non-common') {
                        $q->orWhere('asset_type', 2);
                    }
                });
            })

            ->orderBy('created_at', 'desc')
            ->paginate((int) $this->perPage);

        return view('livewire.ams.asset.asset-list', [
            'assets' => $assets,
            'categories' => AssetCategory::all(),
            'statuses' => AssetStatus::all(),
            'conditions' => AssetCondition::all(),
            'departments' => Department::all(),
        ]);
    }



}
