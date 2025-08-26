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
            BranchSeeder::class,
            DepartmentSeeder::class,
            BrandSeeder::class,
            CandidateSeeder::class,

            // dependent migration
            EmployeeSeeder::class,
            AssetSeeder::class,

            SuperAdminSeeder::class,

            AssetConditionSeeder::class,
            ModuleAndSubmoduleSeeder::class,
        ]);
    }
}
