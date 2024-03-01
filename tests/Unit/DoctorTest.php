<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_create_fail(): void
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->actingAs($user)->post('/admin/doctor/store', [
            'name' => 'Dr. John Doe',
            'email' => 'emaildetest@exemple.com',
            'password' => Hash::make('password'),
            'crm' => '123456',
            'specialty_id' => '1',
            'cpf' => '12345678901',
            'phone' => '12345678901',
            'bdate' => '2021-10-10',
            'adress' => 'Rua teste',
            'pfp' => 'teste.jpg',
            'period' => '00h-06h',

        ]);
        $response->assertStatus(302);
    }

    public function test_create_success(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('password'),
            'birth_date' => '1990-01-01',
        ]);

        $specialty = Specialty::create([
            'name' => 'Cardiología',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças do coração.',
            'price' => 280,
        ]);

        Auth::guard('admin')->login($admin);
        $response = $this->actingAs($admin)->post('/admin/doctor/store', [
            'name' => 'Dr. John Doe',
            'email' => 'emaildetest@exemple.com',
            'password' => Hash::make('password'),
            'crm' => '123456',
            'specialty' => $specialty->id,
            'cpf' => '12345678901',
            'phone' => '12345678901',
            'bdate' => '2021-10-10',
            'adress' => 'Rua teste',
            'pfp' => 'teste.jpg',
        ]);
        $response->assertStatus(200);
    }

    public function test_read(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('password'),
            'birth_date' => '1990-01-01',
        ]);

        Auth::guard('admin')->login($admin);
        $response = $this->actingAs($admin)->get('/admin/doctor');
        $response->assertStatus(200);
    }

    public function test_update_fail(): void
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->actingAs($user)->post('/admin/doctor/edit/1', [
            'name' => 'Dr. John Doe',
            'email' => 'emaildetest@exemple.com',
            'password' => Hash::make('password'),
            'crm' => '123456',
            'specialty' => 1,
            'cpf' => '12345678901',
            'phone' => '12345678901',
            'bdate' => '2021-10-10',
            'adress' => 'Rua teste',
            'pfp' => 'teste.jpg',
        ]);
        
        $response->assertStatus(302);
    }

    public function test_update_sucess(): void
    {
        $admin = Admin::find(1);
        Auth::guard('admin')->login($admin);

        $specialty = Specialty::create([
            'name' => 'Medicina General',
            'desc' => 'Especialidade médica que se ocupa do diagnóstico e tratamento das doenças comuns.',
            'price' => 190,
        ]);

        $response = $this->actingAs($admin)->post('/admin/doctor/edit/1', [
            'name' => 'Dr. John Doe',
            'email' => 'edit@exemple.com',
            'crm' => '123456',
            'specialty_id' => $specialty->id,
            'cpf' => '69874563210',
            'phone' => '40028922',
            'bdate' => '2021-10-10',
            'adress' => 'Rua teste editado',
            'period' => '00h-06h',
            'pfp' => 'teste.jpg',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_fail(): void
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->actingAs($user)->delete('/admin/doctor/destroy/1');
        $response->assertStatus(302);
    }

    public function test_delete_succes(): void
    {
        $admin = Admin::find(1);
        Auth::guard('admin')->loginUsingId(1);
        $response = $this->actingAs($admin)->delete('/admin/doctor/destroy/1');
        $response->assertStatus(200);
    }
}