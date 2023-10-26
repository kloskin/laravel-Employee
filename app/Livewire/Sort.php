<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Sort extends Component
{
    public $sortField='first_name';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.sort', [
            'employees' => Employee::with('company')
                ->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
                ->orderBy($this->sortField, $this->sortDirection)
                ->select('employees.*', 'companies.name AS company_name')
                ->paginate(10)
        ]);

    }
}
