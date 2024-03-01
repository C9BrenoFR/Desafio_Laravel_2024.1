<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar especialidades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2">
            <button type="button" class="btn btn-outline-warning" id="specialtyCreateBtn" onclick="formShow(specialtyCreate, specialtyCreateBtn)">Nova especialidade</button>
            </div>
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg" id="specialtyCreate" style="display: none;">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.specialty.store') }}" method="post">
                        @csrf
                        <div class="flex justify-between items-center">
                            <div></div>
                            <h2 class="text-lg font-bold ">Nova especialidade</h2>
                            <div></div>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <input type="text" name="desc" id="desc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                            <input type="number" name="price" id="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="btn btn-outline-danger me-2" onclick="formShow(specialtyCreate, specialtyCreateBtn)">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($specialties as $specialty)
                        <div class="flex justify-between items-center">
                            <div id="show-{{ $specialty->id }}">
                                <p id="show-name-{{ $specialty->id }}" class="text-lg font-bold fs-4">{{ $specialty->name }}</p>
                                <p id="show-desc-{{ $specialty->id }}" class="text-sm fs-6">{{ $specialty->desc }}</p>
                                <p id="show-price-{{ $specialty->id }}" class="text-sm fs-6">R${{ $specialty->price }}</p>
                            </div>

                            
                            <div class="input-group w-50" hidden id="input-{{ $specialty->id }}">
                                <input type="text" id="input-name-{{ $specialty->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $specialty->name }}">
                                <input type="text" id="input-desc-{{ $specialty->id }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $specialty->desc }}">
                                <input type="text" id="input-price-{{ $specialty->id }}" class="mb-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $specialty->price }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick="specialtyEdit({{ $specialty->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @csrf
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="me-3">
                                    <button onclick="specialtyEditOpen({{ $specialty->id }})">
                                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                                    </button>
                                </div>
                                <div>
                                    <form action="{{ route('admin.specialty.destroy', $specialty->id) }}" method="post" class="inline">
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
                    {{ $specialties->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function specialtyEditOpen(id){
        const showSpecialty = document.getElementById(`show-${id}`);
        const inputSpecialty = document.getElementById(`input-${id}`);
        
        if(showSpecialty.hasAttribute('hidden'))
        {
            showSpecialty.removeAttribute('hidden');
            inputSpecialty.hidden = true;
        }else{
            inputSpecialty.removeAttribute('hidden');
            showSpecialty.hidden = true;
        }
    }

    function specialtyEdit(id)
    {
        let formData = new FormData();
        const name = document.querySelector(`#input-name-${id}`).value;
        const desc = document.querySelector(`#input-desc-${id}`).value;
        const price = document.querySelector(`#input-price-${id}`).value;
        const token = document.querySelector(`input[name="_token"]`).value;
        formData.append('name', name);
        formData.append('desc', desc);
        formData.append('price', price);
        formData.append('_token', token);
        const url = `/admin/specialty/edit/${id}`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            specialtyEditOpen(id);
            document.getElementById(`show-name-${id}`).textContent = name;
            document.getElementById(`show-desc-${id}`).textContent = desc;
            document.getElementById(`show-price-${id}`).textContent = "R$" + price;
        });
    }
</script>