<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = ['name']; 

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'category_id');
    }
}
