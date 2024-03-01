<?php $specialties = App\Models\Specialty::all(); ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agendar procedimento cirurgico') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('mensagem'))
                <div class="alert alert-danger" role="alert">
                    {{ session('mensagem') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/surgery/confirm" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="type">Tipo de procedimento</label>
                            <select class="form-control rounded-1" id="type" name="type" required onchange="Specialty(this)" >
                                <option value="">-- Selecione --</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="doctorf">
                            <label for="doctorf">Medico - Se atente ao horario de trabalho do médico</label>
                            <select class="form-control rounded-1" disabled>
                                <option value="">-- Selecione --</option>
                            </select>
                        </div>

                        @foreach($specialties as $specialty)
                            <div class="mb-3" id="{{ $specialty->id }}" style="display: none;" >
                                <label for="doctor">Medico - Se atente ao horario de trabalho do médico</label>
                                <select class="form-control rounded-1" id="doctor" name="doctor" disabled>
                                    <option value="">-- Selecione --</option>
                                    @foreach($specialty->doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->period }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        <div class="mb-3">
                            <label for="date">Data (Um tempo de duas horas sera resarvado)</label>
                            <input type="datetime-local" class="form-control rounded-1" id="date" name="date" required>
                        </div>

                        <button class="btn btn-outline-success" type="submit">
                            Proximo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

    let ultimoSelect = null;
    function Specialty(selectElement) {
        if (ultimoSelect != null) {
            document.getElementById(ultimoSelect).style.display = "none";
            document.getElementById(ultimoSelect).querySelector('select').disabled = true;
        }
        document.getElementById('doctorf').style.display = "none";

        var valorSelecionado = selectElement.value;
        ultimoSelect = valorSelecionado;

        const doctor = document.getElementById(valorSelecionado);
        doctor.style.display = "block";
        doctor.querySelector('select').disabled = false;
    }

    // Obter a referência ao elemento input
    var inputDate = document.getElementById('date');

    // Obter a data e hora atual em formato ISO (YYYY-MM-DD)
    var dataAtual = new Date().toISOString().slice(0, 16);

    // Definir o atributo min do input para a data atual
    inputDate.setAttribute('min', dataAtual);
</script>