<?php

namespace Database\Seeders;

use App\Models\HealthPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HealthPlan::create([
            'name' => 'SUS',
            'desc' => 'Sistema Único de Saúde',
            'discount' => 100,
        ]);

        HealthPlan::create([
            'name' => 'Unimed',
            'desc' => 'Unimed',
            'discount' => 50,
        ]);

        HealthPlan::create([
            'name' => 'SulAmérica',
            'desc' => 'SulAmérica',
            'discount' => 30,
        ]);

        HealthPlan::create([
            'name' => 'Bradesco Saúde',
            'desc' => 'Bradesco',
            'discount' => 70,
        ]);

        HealthPlan::create([
            'name' => 'Amil',
            'desc' => 'Amil',
            'discount' => 90,
        ]);

        HealthPlan::create([
            'name' => 'Nenhum',
            'desc' => 'Nenhum plano de saúde',
            'discount' => 0,
        ]);

        HealthPlan::create([
            'name' => 'FSFX',
            'desc' => 'Fundação São Francisco Xavier',
            'discount' => 95,
        ]);
    }
}
