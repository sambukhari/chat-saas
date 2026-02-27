<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Agent;

class DemoAuthSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@demo.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('11223344')]
        );

        $company = Company::firstOrCreate(
            ['email' => 'company@demo.com'],
            ['name' => 'Demo Company', 'password' => Hash::make('11223344'), 'plan' => 'pro', 'is_active' => true]
        );

        Agent::firstOrCreate(
            ['email' => 'agent@demo.com'],
            ['company_id' => $company->id, 'name' => 'Demo Agent', 'password' => Hash::make('11223344'), 'is_active' => true]
        );
    }
}