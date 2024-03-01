<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deletar Conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Uma vez que sua conta for deletada, é impossivel reverter essa ação, tenha certeza de não ter nenhuma pendencia a ser resolvida') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Deleter conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="
        @if(Auth::guard('doctor')->check())
            {{ route('doctor.delete', Auth::guard('doctor')->user()->id) }}
        @else
            {{ route('user.delete', Auth::user()->id) }}
        @endif
        " class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Deletar conta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Uma vez que sua conta for deletada, você perdera todos os seus dados, tem certeza que deseja prosseguir?') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Deletar conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
