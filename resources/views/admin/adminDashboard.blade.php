@php
    $patients = App\Models\User::all();
    $doctors = App\Models\Doctor::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-6"><h1>Pacientes no Hospital</h1></div>
                        <div class="col-md-6 float-end">
                            <span class="badge bg-secondary">
                               {{ $patients->count() }}
                            </span>
                        </div>
                      </div>
                    </div>

                    <div class="container">
                      <div class="row">
                        <div class="col-md-6"><h1>Médicos no Hospital</h1></div>
                        <div class="col-md-6 float-end">
                            <span class="badge bg-secondary">
                               {{ $patients->count() }}
                            </span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
