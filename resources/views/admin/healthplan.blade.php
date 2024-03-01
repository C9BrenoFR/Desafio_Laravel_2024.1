<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar planos de saúde') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
            <button type="button" class="btn btn-outline-warning" id="healthplanCreateBtn" onclick="formShow(healthplanCreate, healthplanCreateBtn)">Novo plano de saúde</button>
            </div>
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg" id="healthplanCreate" style="display: none;">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.healthplan.store') }}" method="post">
                        @csrf
                        <div class="flex justify-between items-center">
                            <div></div>
                            <h2 class="text-lg font-bold ">Novo plano de saúde</h2>
                            <div></div>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <input type="text" name="desc" id="desc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium text-gray-700">Desconto</label>
                            <input type="number" name="discount" id="discount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="btn btn-outline-danger me-2" onclick="formShow(healthplanCreate, healthplanCreateBtn)">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($healthplans as $healthplan)
                        <div class="flex justify-between items-center">
                            <div id="show-{{ $healthplan->id }}">
                                <p id="show-name-{{ $healthplan->id }}" class="text-lg font-bold fs-4">{{ $healthplan->name }}</p>
                                <p id="show-desc-{{ $healthplan->id }}" class="text-sm fs-6">{{ $healthplan->desc }}</p>
                                <p id="show-discount-{{ $healthplan->id }}" class="text-sm fs-6">{{ $healthplan->discount }}% de desconto</p>
                            </div>

                            
                            <div class="input-group w-50" hidden id="input-{{ $healthplan->id }}">
                                <input type="text" id="input-name-{{ $healthplan->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $healthplan->name }}">
                                <input type="text" id="input-desc-{{ $healthplan->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $healthplan->desc }}">
                                <input type="text" id="input-discount-{{ $healthplan->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $healthplan->discount }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="healthplanEdit({{ $healthplan->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @csrf
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="me-3">
                                    <button onclick="healthplanEditOpen({{ $healthplan->id }})">
                                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                                    </button>
                                </div>
                                <div>
                                    <form action="{{ route('admin.healthplan.destroy', $healthplan->id) }}" method="post" class="inline">
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
                    {{ $healthplans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function healthplanEditOpen(id){
        const showhealthplan = document.getElementById(`show-${id}`);
        const inputhealthplan = document.getElementById(`input-${id}`);
        
        if(showhealthplan.hasAttribute('hidden'))
        {
            showhealthplan.removeAttribute('hidden');
            inputhealthplan.hidden = true;
        }else{
            inputhealthplan.removeAttribute('hidden');
            showhealthplan.hidden = true;
        }
    }

    function healthplanEdit(id)
    {
        let formData = new FormData();
        const name = document.querySelector(`#input-name-${id}`).value;
        const desc = document.querySelector(`#input-desc-${id}`).value;
        const discount = document.querySelector(`#input-discount-${id}`).value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('name', name);
        formData.append('desc', desc);
        formData.append('discount', discount);
        formData.append('_token', token);
        const url = `/admin/healthplan/edit/${id}`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            healthplanEditOpen(id);
            document.getElementById(`show-name-${id}`).textContent = name;
            document.getElementById(`show-desc-${id}`).textContent = desc;
            document.getElementById(`show-discount-${id}`).textContent = discount + "% De desconto";
        });
    }
</script>