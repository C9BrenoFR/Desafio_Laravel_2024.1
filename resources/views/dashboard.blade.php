<?php 
$HealthPlans = App\Models\HealthPlan::all(); 
$surgerys = App\Models\Surgery::all();

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::user()->fst_login == 1)
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('mensagem'))
                <div class="alert alert-danger" role="alert">
                    {{ session('mensagem') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Suas Cirurgias") }}

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">Médico</th>
                                <th scope="col">Data</th>
                                <th scope="col">Preço</th>
                                <th scope="col" class="text-center">Cancelar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surgerys as $surgery)
                            @can('view', $surgery)
                            <?php 
                            $dateStart = new DateTime($surgery->date_start);
                            $dateStartString = $dateStart->format('d/m/Y H:i');
                            ?>
                            <tr>
                                <td class="align-middle">{{ $surgery->type }}</td>
                                <td class="align-middle">{{ $surgery->doctor->name }}</td>
                                <td class="align-middle">{{ $dateStartString }}</td>
                                <td class="align-middle">{{ $surgery->price }}</td>
                                @can('delete', $surgery)
                                <form action="/surgery/delete" method="post">
                                    @csrf
                                    <td class="text-center">
                                    <input type="hidden" name="id" value="{{ $surgery->id }}">
                                    <input type="hidden" name="date" value="{{ $dateStartString }}">
                                    <button class="btn btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                                </form>
                                @endcan
                            </tr>
                            @endcan
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->fst_login == 0)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="/completeregister" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Endereço</label>
                            <input type="text" class="form-control rounded-1" id="adress" name="adress" required>
                        </div>

                        <div class="mb-3">
                            <label for="name">Telefone</label>
                            <input type="text" class="form-control rounded-1" id="phone" name="phone" oninput="formatarTelefone(this)" required>
                            <div class="mt-1" id="telefoneError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name">CPF</label>
                            <input type="text" class="form-control rounded-1" id="cpf" name="cpf" oninput="formatarCPF(this)" required>
                            <div class="mt-1" id="cpfError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name">Tipo Sanguineo</label>
                            <select id="tipoSanguineo" name="abo" class="form-control rounded-1" required>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="AB+">AB+</option>
                              <option value="AB-">AB-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name">Plano de Saúde</label>
                            <select id="healthp_id" name="healthp_id" class="form-control rounded-1" required>
                                @foreach($HealthPlans as $HealthPlan)
                                    <option value="{{ $HealthPlan->id }}">{{ $HealthPlan->name }}</option>
                                @endforeach
                            </select>

                            <div>
                                <x-input-label for="pfp" :value="__('Foto de perfil')" />
                                <input id="pfp" name="pfp" type="file" class="mt-1 block w-full"/>
                            </div>
                        
                        <button type="submit" class="btn btn-outline-primary">Completar Cadastro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
