@php
$date = new DateTime();
$dateString = $date->format('d/m/Y H:i');
@endphp
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hospital</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    </head>
    <main class="p-5">
        <div class="p-5 mb-4 mt-2 bg-body-secondary rounded-3">
            <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
                Relatório médico               
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $doctor->name }} : {{ $dateString }}
            </h2>
        </div>
        
        @if (empty($surgeries))
        <div class="alert alert-warning" role="alert">
            Não há cirurgias agendadas
        </div>
        @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Paciente</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Data de inicio</th>
                    <th scope="col">Preço</th>
                </tr>
            </thead>
            <tbody>
            @php
                $currentMonth = null;
            @endphp

            @foreach($surgeries as $surgery)
                @php
                    $dateStart = new DateTime($surgery->date_start);
                    $month = $dateStart->format('m');
                    $year = $dateStart->format('Y');
                    $dateStartString = $dateStart->format('d/m/Y H:i');
                @endphp

                @if ($currentMonth !== $month)
                @php
                    $currentMonth = $month;
                    $monthName = DateTime::createFromFormat('!m', $currentMonth)->format('F');
                    $yearName = DateTime::createFromFormat('!Y', $year)->format('Y');
                @endphp

                <tr>
                    <td colspan="4" class="text-center font-weight-bold bg-light">{{ $monthName }} - {{ $yearName }}</td>
                </tr>
                @endif
                @php
                $dateStart = new DateTime($surgery->date_start);
                $dateStartString = $dateStart->format('d/m/Y H:i');
                @endphp
                <tr>
                    <td class="align-middle">{{ $surgery->patient->name }}</td>
                    <td class="align-middle">{{ $surgery->type }}</td>
                    <td class="align-middle">{{ $dateStartString }}</td>
                    <td class="align-middle">{{ $surgery->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        </main>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
