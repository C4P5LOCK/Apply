<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application;

class SearchApplications extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $applications = Application::where('full_name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.search-applications', [
            'applications' => $applications
        ]);
    }
}