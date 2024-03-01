@php
 $surgeries = Auth::guard('doctor')->user()->surgeries()->get();
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
                    <h1 class="text-3xl font-bold mb-4">Bem vindo, {{ Auth::guard('doctor')->user()->name }}!</h1>
                    <div class="flex flex-wrap">
                        <p>
                            Cirurgias agendadas 
                            <span class="badge bg-secondary">
                               {{ $surgeries->count() }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>