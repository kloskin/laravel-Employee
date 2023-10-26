<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;

class Search extends Component
{
    public $search='';

    public function render()
    {
        $employees = [];
        if ($this->search) {
            $employees = Employee::where('email', 'like', '%' . $this->search . '%')
                ->orWhere('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->get();
        }

        return view('livewire.search', [
            'employees' => $employees,
        ]);
    }
}
