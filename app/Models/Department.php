<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
	
    protected $table = 'departments';
	
    public function users()
    {
		return $this->hasMany('\App\Models\DepartmentUsers', 'department_id', 'id');
    }
}
