<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

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
