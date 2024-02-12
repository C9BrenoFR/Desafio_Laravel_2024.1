<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialty::create([
            'name' => 'Medicina General',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças comuns.',
            'price' => 150,
        ]);
        
        Specialty::create([
            'name' => 'Cardiología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do coração.',
            'price' => 280,
        ]);

        Specialty::create([
            'name' => 'Neurología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do sistema nervoso.',
            'price' => 280,
        ]);

        Specialty::create([
            'name' => 'Oftalmología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças dos olhos.',
            'price' => 200,
        ]);

        Specialty::create([
            'name' => 'Otorrinolaringología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do ouvido, nariz e garganta.',
            'price' => 300,
        ]);

        Specialty::create([
            'name' => 'Urología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do sistema urinário.',
            'price' => 250,
        ]);

        Specialty::create([
            'name' => 'Ginecología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do sistema reprodutor feminino.',
            'price' => 180,
        ]);

        Specialty::create([
            'name' => 'Pediatría',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças das crianças.',
            'price' => 220,
        ]);

        Specialty::create([
            'name' => 'Psiquiatría',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças mentais.',
            'price' => 250,
        ]);
        
        Specialty::create([
            'name' => 'Dermatología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças da pele.',
            'price' => 200,
        ]);

        Specialty::create([
            'name' => 'Endocrinología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças das glândulas.',
            'price' => 270,
        ]);

        Specialty::create([
            'name' => 'Hematología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do sangue.',
            'price' => 300,
        ]);

        Specialty::create([
            'name' => 'Gastroenterología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do aparelho digestivo.',
            'price' => 240,
        ]);

        Specialty::create([
            'name' => 'Infectología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças infecciosas.',
            'price' => 190,
        ]);

    }
}
