<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar medicos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
            <button type="button" class="btn btn-outline-warning" id="doctorCreateBtn" onclick="formShow(doctorCreate, doctorCreateBtn)">Novo medico</button>
            </div>
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg" id="doctorCreate" style="display: none;">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.doctor.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="flex justify-between items-center">
                            <div></div>
                            <h2 class="text-lg font-bold ">Novo medico</h2>
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
                        <div class="mb-4">
                            <label for="adress" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="adress" id="adress" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="specialty" class="block text-sm font-medium text-gray-700">Especialidade</label>
                            <select name="specialty" id="specialty" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="period" class="block text-sm font-medium text-gray-700">Período</label>
                            <select name="period" id="period" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                <option value="00h-06h">00h-06h</option>
                                <option value="06h-12h">06h-12h</option>
                                <option value="12h-18h">12h-18h</option>
                                <option value="18h-00h">18h-00h</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="pfp" class="block text-sm font-medium text-gray-700">Foto de perfil</label>
                            <input type="file" name="pfp" id="pfp" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="crm" class="block text-sm font-medium text-gray-700">CRM</label>
                            <input type="text" name="crm" id="crm" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="btn btn-outline-danger me-2" onclick="formShow(doctorCreate, doctorCreateBtn)">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($doctors as $doctor)
                        <div class="flex justify-between items-center">
                            <div>
                            <img src="{{ $doctor->pfp }}" alt="Foto de perfil" class="w-20 h-20 rounded-full">
                            </div>
                            <div id="show-{{ $doctor->id }}">
                                <p id="show-name-{{ $doctor->id }}" class="text-lg font-bold fs-4">{{ $doctor->name }}</p>
                                <p id="show-email-{{ $doctor->id }}" class="text-sm fs-6">{{ $doctor->email }}</p>
                                <div id="show-all-{{ $doctor->id }}" hidden>
                                    <p id="show-bdate-{{ $doctor->id }}" class="text-sm fs-6">{{ $doctor->bdate }}</p>
                                    <p id="show-adress-{{ $doctor->id }}"  class="text-sm fs-6">{{ $doctor->adress }}</p>
                                    <p id="show-phone-{{ $doctor->id }}"  class="text-sm fs-6">{{ $doctor->phone }}</p>
                                    <p id="show-cpf-{{ $doctor->id }}"  class="text-sm fs-6">{{ $doctor->cpf }}</p>
                                    <p id="show-period-{{ $doctor->id }}"  class="text-sm fs-6">{{ $doctor->period }}</p>
                                    <p id="show-crm-{{ $doctor->id }}"  class="text-sm fs-6">{{ $doctor->crm }}</p>
                                    <p id="show-specialty-{{ $doctor->id }}"  class="text-sm fs-6">
                                    @foreach ($specialties as $specialty)
                                        @if($specialty->id == $doctor->specialty_id)
                                            {{ $specialty->name }}
                                        @endif
                                    @endforeach
                                    </p>
                                </div>
                            </div>

                            
                            <div class="input-group w-50" hidden id="input-{{ $doctor->id }}">
                                <input type="text" id="input-name-{{ $doctor->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->name }}">
                                <input type="text" id="input-email-{{ $doctor->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->email }}">
                                <input type="date" id="input-bdate-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->bdate }}">
                                <input type="text" id="input-adress-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->adress }}">
                                <input type="text" oninput="formatarTelefone(this)" id="input-phone-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->phone }}">
                                <input type="text" oninput="formatarCPF(this)" id="input-cpf-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->cpf }}">
                                <input type="text" id="input-crm-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $doctor->crm }}">
                                <select name="specialty_id" id="input-specialty_id-{{ $doctor->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}" {{ $specialty->id == $doctor->specialty_id ? 'selected' : '' }} >{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                                <select id="input-period-{{ $doctor->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="00h-06h">00h-06h</option>
                                    <option value="06h-12h">06h-12h</option>
                                    <option value="12h-18h">12h-18h</option>
                                    <option value="18h-00h">18h-00h</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="doctorEdit({{ $doctor->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @csrf
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="me-3">
                                    <button onclick="doctorViewOpen({{ $doctor->id }})">
                                    <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                                <div class="me-3">
                                    <button onclick="doctorEditOpen({{ $doctor->id }})">
                                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                                    </button>
                                </div>
                                <div>
                                    <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="post" class="inline">
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
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function doctorEditOpen(id){
        const showdoctor = document.getElementById(`show-${id}`);
        const inputdoctor = document.getElementById(`input-${id}`);
        
        if(showdoctor.hasAttribute('hidden'))
        {
            showdoctor.removeAttribute('hidden');
            inputdoctor.hidden = true;
        }else{
            inputdoctor.removeAttribute('hidden');
            showdoctor.hidden = true;
        }
    }

    function doctorEdit(id)
    {
        let formData = new FormData();
        const name = document.querySelector(`#input-name-${id}`).value;
        const email = document.querySelector(`#input-email-${id}`).value;
        const bdate = document.querySelector(`#input-bdate-${id}`).value;
        const adress = document.querySelector(`#input-adress-${id}`).value;
        const phone = document.querySelector(`#input-phone-${id}`).value;
        const cpf = document.querySelector(`#input-cpf-${id}`).value;
        const specialty_id = document.querySelector(`#input-specialty_id-${id}`).value;
        const crm = document.querySelector(`#input-crm-${id}`).value;
        const period = document.querySelector(`#input-period-${id}`).value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('name', name);
        formData.append('email', email);
        formData.append('bdate', bdate);
        formData.append('adress', adress);
        formData.append('phone', phone);
        formData.append('cpf', cpf);
        formData.append('specialty_id', specialty_id);
        formData.append('crm', crm);
        formData.append('period', period);
        formData.append('_token', token);
        const url = `/admin/doctor/edit/${id}`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            doctorEditOpen(id);
            document.getElementById(`show-name-${id}`).textContent = name;
            document.getElementById(`show-email-${id}`).textContent = email;
            document.getElementById(`show-bdate-${id}`).textContent = bdate;
            document.getElementById(`show-adress-${id}`).textContent = adress;
            document.getElementById(`show-phone-${id}`).textContent = phone;
            document.getElementById(`show-cpf-${id}`).textContent = cpf;
            document.getElementById(`show-specialty-${id}`).textContent = specialty;
        });
    }

    function doctorViewOpen(id){
        const showdoctor = document.getElementById(`show-all-${id}`);
        if(showdoctor.hasAttribute('hidden'))
        {
            showdoctor.removeAttribute('hidden');
        }else{
            showdoctor.hidden = true;
        }
    }
</script>