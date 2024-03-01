<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
            <button type="button" class="btn btn-outline-warning" id="patientCreateBtn" onclick="formShow(patientCreate, patientCreateBtn)">Nova paciente</button>
            </div>
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg" id="patientCreate" style="display: none;">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.patient.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between items-center">
                            <div></div>
                            <h2 class="text-lg font-bold ">Novo paciente</h2>
                            <div></div>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="bdate" class="block text-sm font-medium text-gray-700">Data de nascimento</label>
                            <input type="date" name="bdate" id="bdate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                            <input type="text" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="btn btn-outline-danger me-2" onclick="formShow(patientCreate, patientCreateBtn)">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($patients as $patient)
                        <div class="flex justify-between items-center">
                            <div>
                            <img src="{{ empty($patient->pfp) ? "uploads/default.jpg" : $patient->pfp }}" alt="Foto de perfil" class="w-20 h-20 rounded-full">
                            </div>
                            <div id="show-{{ $patient->id }}">
                                <p id="show-name-{{ $patient->id }}" class="text-lg font-bold fs-4">{{ $patient->name }}</p>
                                <p id="show-email-{{ $patient->id }}" class="text-sm fs-6">{{ $patient->email }}</p>
                                <div id="show-all-{{ $patient->id }}" hidden>
                                    <p id="show-bdate-{{ $patient->id }}" class="text-sm fs-6">{{ $patient->bdate }}</p>
                                    <p id="show-adress-{{ $patient->id }}"  class="text-sm fs-6">{{ $patient->adress }}</p>
                                    <p id="show-phone-{{ $patient->id }}"  class="text-sm fs-6">{{ $patient->phone }}</p>
                                    <p id="show-cpf-{{ $patient->id }}"  class="text-sm fs-6">{{ $patient->cpf }}</p>
                                    <p id="show-abo-{{ $patient->id }}"  class="text-sm fs-6">{{ $patient->abo }}</p>
                                    <p id="show-healthp_id-{{ $patient->id }}"  class="text-sm fs-6">
                                    @foreach ($healthplans as $healthplan)
                                        @if($healthplan->id == $patient->healthp_id)
                                            {{ $healthplan->name }}
                                        @endif
                                    @endforeach
                                    </p>
                                    <p id="show-complete-{{ $patient->id }}"  class="text-sm fs-6">
                                    @if($patient->fst_login == 0)
                                        Cadastro incompleto
                                    @elseif($patient->fst_login == 1)
                                        Cadastro completo
                                    @endif
                                    </p>
                                </div>
                            </div>

                            
                            <div class="input-group w-50" hidden id="input-{{ $patient->id }}">
                                <input type="text" id="input-name-{{ $patient->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->name }}">
                                <input type="text" id="input-email-{{ $patient->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->email }}">
                                <input type="text" id="input-bdate-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->bdate }}">
                                <input type="text" id="input-adress-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->adress }}">
                                <input type="text" oninput="formatarTelefone(this)" id="input-phone-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->phone }}">
                                <input type="text" oninput="formatarCPF(this)" id="input-cpf-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->cpf }}">
                                <input type="text" id="input-abo-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $patient->abo }}">
                                <select name="healthp_id" id="input-healthp_id-{{ $patient->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @foreach ($healthplans as $healthplan)
                                        <option value="{{ $healthplan->id }}" {{ $healthplan->id == $patient->healthp_id ? 'selected' : '' }} >{{ $healthplan->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="patientEdit({{ $patient->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @csrf
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="me-3">
                                    <button onclick="patientViewOpen({{ $patient->id }})">
                                    <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                                <div class="me-3">
                                    <button onclick="patientEditOpen({{ $patient->id }})">
                                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                                    </button>
                                </div>
                                <div>
                                    <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash fs-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                    @endforeach
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function patientEditOpen(id){
        const showpatient = document.getElementById(`show-${id}`);
        const inputpatient = document.getElementById(`input-${id}`);
        
        if(showpatient.hasAttribute('hidden'))
        {
            showpatient.removeAttribute('hidden');
            inputpatient.hidden = true;
        }else{
            inputpatient.removeAttribute('hidden');
            showpatient.hidden = true;
        }
    }

    function patientEdit(id)
    {
        let formData = new FormData();
        const name = document.querySelector(`#input-name-${id}`).value;
        const email = document.querySelector(`#input-email-${id}`).value;
        const bdate = document.querySelector(`#input-bdate-${id}`).value;
        const adress = document.querySelector(`#input-adress-${id}`).value;
        const phone = document.querySelector(`#input-phone-${id}`).value;
        const cpf = document.querySelector(`#input-cpf-${id}`).value;
        const abo = document.querySelector(`#input-abo-${id}`).value;
        const healthp_id = document.querySelector(`#input-healthp_id-${id}`).value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('name', name);
        formData.append('email', email);
        formData.append('bdate', bdate);
        formData.append('adress', adress);
        formData.append('phone', phone);
        formData.append('cpf', cpf);
        formData.append('abo', abo);
        formData.append('healthp_id', healthp_id);
        formData.append('_token', token);
        const url = `/admin/patient/edit/${id}`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            patientEditOpen(id);
            document.getElementById(`show-name-${id}`).textContent = name;
            document.getElementById(`show-email-${id}`).textContent = email;
            document.getElementById(`show-bdate-${id}`).textContent = bdate;
            document.getElementById(`show-adress-${id}`).textContent = adress;
            document.getElementById(`show-phone-${id}`).textContent = phone;
            document.getElementById(`show-cpf-${id}`).textContent = cpf;
            document.getElementById(`show-abo-${id}`).textContent = abo;
        });
    }

    function patientViewOpen(id){
        const showpatient = document.getElementById(`show-all-${id}`);
        if(showpatient.hasAttribute('hidden'))
        {
            showpatient.removeAttribute('hidden');
        }else{
            showpatient.hidden = true;
        }
    }
</script>