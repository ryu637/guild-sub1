<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Company ユーザーを取得
        $companyUsers = DB::table('users')->where('role_id', 2)->get();

        $companies = [
            [
                'user_id' => $companyUsers[0]->id,
                'address' => '123 Tech Street, San Francisco, CA',
                'website' => 'https://techcorp.com',
                'total_spent' => 500000.00,
                'representative' => 'David Johnson',
                'employee' => 150,
                'capital' => 10000000.00,
                'annualsales' => 50000000.00,
                'description' => 'A leading technology corporation.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $companyUsers[1]->id,
                'address' => '789 Cloud Avenue, Seattle, WA',
                'website' => 'https://cloudsolutions.com',
                'total_spent' => 250000.00,
                'representative' => 'Sarah Williams',
                'employee' => 100,
                'capital' => 5000000.00,
                'annualsales' => 30000000.00,
                'description' => 'Cloud computing and AI solutions provider.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $companyUsers[2]->id,
                'address' => '456 Startup Road, Austin, TX',
                'website' => 'https://startup.com',
                'total_spent' => 150000.00,
                'representative' => 'James Brown',
                'employee' => 50,
                'capital' => 2000000.00,
                'annualsales' => 10000000.00,
                'description' => 'A promising new startup in FinTech.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('companies')->insert($companies);
    }
}
