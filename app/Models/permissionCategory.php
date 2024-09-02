<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;
// use Modules\User\Database\Factories\PermissionCategoryFactory;
use Spatie\Permission\Models\Permission;

class PermissionCategory extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'category_id');
    }
}
