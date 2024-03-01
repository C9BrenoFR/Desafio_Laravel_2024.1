<?php 
$HealthPlans = App\Models\HealthPlan::all();
if(Auth::guard('doctor')->check()){
$doctor = Auth::guard('doctor')->user();
$specialties = App\Models\Specialty::all();
} 
?>
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Editar perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualizar informações de perfil") }}
        </p>
    </header>

    @if (Auth::guard('web')->check())
    <form method="POST" action="/profileupdate" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        
        <div>
            <x-input-label for="pfp" :value="__('Foto de perfil')" />
            <img src="{{ empty($user->pfp) ? "/uploads/default.jpg" : $user->pfp }}" alt="Foto de perfil" class="w-20 h-20 rounded-full">
            <input id="pfp" name="pfp" type="file" class="mt-1 block w-full"/>
        </div>
        
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
                
        <div>
            <x-input-label for="adress" :value="__('Endereço')" />
            <x-text-input id="adress" name="adress" type="text" class="mt-1 block
            w-full" :value="old('adress', $user->adress)" required autofocus autocomplete="adress" />
            <x-input-error class="mt-2" :messages="$errors->get('adress')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Telefone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block
            w-full" :value="old('phone', $user->phone)" required autofocus oninput="formatarTelefone(this)" autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="cpf" :value="__('Cpf')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block
            w-full" :value="old('cpf', $user->cpf)" required oninput="formatarCPF(this)" autofocus autocomplete="cpf" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div>
            <x-input-label for="abo" :value="__('Tipo Sanguineo')" />
            <select id="abo" name="abo" class="mt-1 block
            w-full rounded-md" required>
                <option value="A+" {{ old('abo', $user->abo) == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('abo', $user->abo) == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('abo', $user->abo) == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('abo', $user->abo) == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('abo', $user->abo) == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('abo', $user->abo) == 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ old('abo', $user->abo) == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('abo', $user->abo) == 'O-' ? 'selected' : '' }}>O-</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('abo')" />
        </div>

        <div>
            <x-input-label for="healthp_id" :value="__('Plano de saude')" />
            <select id="healthp_id" name="healthp_id" class="mt-1 block
            w-full rounded-md" required>
                @foreach ($HealthPlans as $healthPlan)
                    <option value="{{ $healthPlan->id }}" {{ old('healthp_id', $user->healthp_id) == $healthPlan->id ? 'selected' : '' }}>{{ $healthPlan->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('healthp_id')" />
        </div>

        <div>
            <x-input-label for="bdate" :value="__('Data de nascimento')" />
            <x-text-input id="bdate" name="bdate" type="date" class="mt-1 block
            w-full" :value="old('bdate', $user->bdate)" required autofocus autocomplete="bdate" />
            <x-input-error class="mt-2" :messages="$errors->get('bdate')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    @endif

    @if (Auth::guard('doctor')->check())
    <form method="POST" action="/doctor/profileupdate/{{$doctor->id}}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        
        <div>
            <x-input-label for="pfp" :value="__('Foto de perfil')" />
            <img src="{{ empty($doctor->pfp) ? "/uploads/default.jpg" : $doctor->pfp }}" alt="Foto de perfil" class="w-20 h-20 rounded-full">
            <input id="pfp" name="pfp" type="file" class="mt-1 block w-full"/>
        </div>
        
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $doctor->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $doctor->email)" required autocomplete="doctorname" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
                
        <div>
            <x-input-label for="adress" :value="__('Endereço')" />
            <x-text-input id="adress" name="adress" type="text" class="mt-1 block
            w-full" :value="old('adress', $doctor->adress)" required autofocus autocomplete="adress" />
            <x-input-error class="mt-2" :messages="$errors->get('adress')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Telefone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block
            w-full" :value="old('phone', $doctor->phone)" required autofocus oninput="formatarTelefone(this)" autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="cpf" :value="__('Cpf')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block
            w-full" :value="old('cpf', $doctor->cpf)" required autofocus oninput="formatarCPF(this)" autocomplete="cpf" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div>
            <x-input-label for="specialty_id" :value="__('Especialidade')" />
            <select id="specialty_id" name="specialty_id" class="mt-1 block
            w-full rounded-md" required>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('specialty', $doctor->specialty_id) == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('specialty')" />
        </div>

        <div>
            <x-input-label for="period" :value="__('Periodo')" />
            <select id="period" name="period" class="mt-1 block
            w-full rounded-md" required>
                <option value="00h-06h" {{ old('period', $doctor->period) == '00h-06h' ? 'selected' : '' }}>00h-06h</option>
                <option value="06h-12h" {{ old('period', $doctor->period) == '06h-12h' ? 'selected' : '' }}>06h-12h</option>
                <option value="12h-18h" {{ old('period', $doctor->period) == '12h-18h' ? 'selected' : '' }}>12h-18h</option>
                <option value="18h-00h" {{ old('period', $doctor->period) == '18h-00h' ? 'selected' : '' }}>18h-00h</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('period')" />
        </div>

        <div>
            <x-input-label for="bdate" :value="__('Data de nascimento')" />
            <x-text-input id="bdate" name="bdate" type="date" class="mt-1 block
            w-full" :value="old('bdate', $doctor->bdate)" required autofocus autocomplete="bdate" />
            <x-input-error class="mt-2" :messages="$errors->get('bdate')" />
        </div>

        <div>
            <x-input-label for="crm" :value="__('CRM')" />
            <x-text-input id="crm" name="crm" type="text" class="mt-1 block
            w-full" :value="old('crm', $doctor->crm)" required autofocus autocomplete="crm" />
            <x-input-error class="mt-2" :messages="$errors->get('crm')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    @endif
</section>
