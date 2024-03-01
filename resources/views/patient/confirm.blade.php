<?php $specialties = App\Models\Specialty::all(); ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirmar agendamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/surgery/create" method="post">
                        @csrf
                      
                        <div class="mb-3">
                            <label for="type">Tipo de procedimento</label>
                            <input type="text" class="form-control rounded-1" id="type" name="type" value="{{$type}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="doctor">Medico</label>
                            <input type="text" class="form-control rounded-1" id="doctor" name="doctor" value="{{$doctor}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dateS">Data de inicio</label>
                            <input type="text" class="form-control rounded-1" id="dateS" name="dateS" value="{{$dateStart->format('d/m/Y H:i')}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dateE">Data de saida</label>
                            <input type="text" class="form-control rounded-1" id="dateE" name="dateE" value="{{$dateEnd->format('d/m/Y H:i')}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="price">Preço</label>
                            <input type="text" class="form-control rounded-1" id="price" name="price" value="R$ {{$price}}" readonly>
                        </div>
                        

                        <div class="alert alert-warning" role="alert">
                            Um procedimento cirurgico pode ser cancelado com até 72 horas de antecedencia.
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
