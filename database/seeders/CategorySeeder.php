<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PermissionCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'user management',
            'client management',
            'report management',
            'system management', 
            'invoice management'   
        ];
        foreach ($categories as $categoryName) {
            // DB::table('permission_categories')->insert([
            //     'name' => $categoryName,
            // ]);
            $category = PermissionCategory::firstOrCreate(['name' => $categoryName]);
        }
        
    }
}
