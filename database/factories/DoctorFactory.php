<?php

namespace Database\Factories;

use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialtyIds = Specialty::pluck('id')->toArray();

        $numerocrm = fake()->numerify('######');
        $siglacrm = fake()->randomElement(['CRM/SP', 'CRM/RJ', 'CRM/MG', 'CRM/RS', 'CRM/PR', 'CRM/SC', 'CRM/DF', 'CRM/GO', 'CRM/MT', 'CRM/MS', 'CRM/BA', 'CRM/SE', 'CRM/AL', 'CRM/PE', 'CRM/PB', 'CRM/RN', 'CRM/CE', 'CRM/PI', 'CRM/MA', 'CRM/PA', 'CRM/AP', 'CRM/TO', 'CRM/RO', 'CRM/AC', 'CRM/RR', 'CRM/AM']);

        $crm = $numerocrm . $siglacrm;

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'bdate' => fake()->dateTimeBetween('-60 years', '-26 years')->format('Y-m-d'),
            'phone' => fake()->phoneNumber(),
            'cpf' => fake()->numerify('###.###.###-##'),
            'adress' => fake()->address(),
            'pfp' => fake()->imageUrl(),
            'period' => fake()->randomElement(['00h-06h', '06h-12h', '12h-18h', '18h-00h']),
            'crm' => $crm,
            'specialty_id' => fake()->randomElement($specialtyIds),
        ];
    }
}
