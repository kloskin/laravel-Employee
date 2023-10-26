<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = [
            'first_name',
            'last_name' ,
            'company_id',
            'email',
            'phone',
    ];

    public function dietaryPreferences()
    {
        return $this->belongsToMany(Dietary::class, 'employee_dietary', 'employee_id', 'dietary_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
