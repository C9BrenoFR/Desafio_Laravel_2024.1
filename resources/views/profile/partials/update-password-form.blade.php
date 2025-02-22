<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Atualizar senha') }}
        </h2>
    </header>

    <form method="post" action="
    @if(Auth::guard('doctor')->check())
            {{ route('doctor.update.password', Auth::guard('doctor')->user()->id) }}
        @else
            {{ route('user.update.password', Auth::user()->id) }}
        @endif
    " class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="current_password" :value="__('Senha atual')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nova Senha')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
        </div>
    </form>
</section>
