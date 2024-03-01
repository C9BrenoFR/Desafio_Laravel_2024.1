<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seus Agendamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Paciente</th>
                                <th scope="col">Data de inicio</th>
                                <th scope="col">Data de finalização</th>
                                <th scope="col">Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surgeries as $surgery)
                            <?php 
                            $dateStart = new DateTime($surgery->date_start);
                            $dateStartString = $dateStart->format('d/m/Y H:i');
                            $dateEnd = new DateTime($surgery->date_end);
                            $dateEndString = $dateEnd->format('d/m/Y H:i');
                            ?>
                            <tr>
                                <td class="align-middle">{{ $surgery->patient->name }}</td>
                                <td class="align-middle">{{ $dateStartString }}</td>
                                <td class="align-middle">{{ $dateEndString }}</td>
                                <td class="align-middle">{{ $surgery->price }}</td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $surgeries->links() }}
                </div>
            </div>
            <div class="mt-2">
            <form action="{{ route('doctor.medicalreport') }}" method="get">
                @csrf
                <button class="btn btn-outline-info">Gerar Relatório</button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>