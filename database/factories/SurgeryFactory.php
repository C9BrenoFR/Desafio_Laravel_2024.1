<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surgery>
 */
class SurgeryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $DoctorIds = Doctor::pluck('id')->toArray();
        $specialty = Specialty::pluck('name')->toArray();
        $PatientIds = User::pluck('id')->toArray();

        $dateStart = fake()->dateTimeBetween('now', '+3 years');
        $dateEnd = clone $dateStart;
        $dateEnd->modify('+2 hours');
        $dateStart = $dateStart->format('Y-m-d H:i:s');
        $dateEnd = $dateEnd->format('Y-m-d H:i:s');


        return [
            'type' => fake()->randomElement($specialty),
            'date_start' => $dateStart,  
            'date_end' => $dateEnd,
            'doctor_id' => fake()->randomElement($DoctorIds),
            'patient_id' => fake()->randomElement($PatientIds),
            'price' => fake()->numerify('R$ ###,##')
        ];
    }
}
