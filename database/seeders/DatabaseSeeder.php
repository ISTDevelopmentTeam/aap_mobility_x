<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // independent migrations
            AssetCategorySeeder::class,
            AssetStatusSeeder::class,
            AssetConditionSeeder::class,
            BranchSeeder::class,
            BrandSeeder::class,
            CandidateSeeder::class,
            DepartmentSeeder::class,

            // dependent migration
            EmployeeSeeder::class,
            AssetSeeder::class,
            
            SuperAdminSeeder::class,
            ModuleAndSubmoduleSeeder::class,
        ]);
    }
}
