<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUsers extends Model
{	
    protected $table = 'departments_users';	
	
    public function user()
    {
		return $this->belongsTo('\App\Models\User', 'user_id', 'id');
    }
}
