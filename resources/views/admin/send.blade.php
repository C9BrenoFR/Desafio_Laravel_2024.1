<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enviar email') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('send.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="block text-sm font-medium text-gray-700">Assunto</label>
                            <input type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="block text-sm font-medium text-gray-700">Mensagem</label>
                            <textarea class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-success">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
