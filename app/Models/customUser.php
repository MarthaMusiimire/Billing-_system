<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class customUser extends Model
{
    use HasFactory;  use HasRoles;
    protected $fillable = [
        'name', 
        'email',
        'password',
        'role'
    ];

//     public function role()
// // {
// //     return $this->belongsTo(Role::class); // Ensure this is correct
// // }
}
