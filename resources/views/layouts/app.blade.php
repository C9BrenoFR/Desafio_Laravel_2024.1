<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hospital</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <script>
        function formatarTelefone(input) {
            // Remove caracteres não numéricos
            let value = input.value.replace(/\D/g, '');

            // Formata o número de telefone
            if (value.length === 11) {
                input.value = `(${value.slice(0, 2)})${value.slice(2, 7)}-${value.slice(7)}`;
                document.getElementById('telefoneError').classList.remove('alert');
                document.getElementById('telefoneError').classList.remove('alert-danger');
                document.getElementById('telefoneError').textContent = '';
            } else {
                document.getElementById('telefoneError').classList.add('alert');
                document.getElementById('telefoneError').classList.add('alert-danger');
                document.getElementById('telefoneError').textContent = 'Número de telefone inválido';
            }  
        }

        function formatarCPF(input) {
            // Remove caracteres não numéricos
            let value = input.value.replace(/\D/g, '');

            // Formata o CPF
            if (value.length === 11) {
                input.value = `${value.slice(0, 3)}.${value.slice(3, 6)}.${value.slice(6, 9)}-${value.slice(9)}`;
                document.getElementById('cpfError').classList.remove('alert');
                document.getElementById('cpfError').classList.remove('alert-danger');
                document.getElementById('cpfError').textContent = '';
            } else {
                document.getElementById('cpfError').classList.add('alert');
                document.getElementById('cpfError').classList.add('alert-danger');
                document.getElementById('cpfError').textContent = 'CPF inválido';
            }
        }

        function formShow(form, btn) {
            if (form.style.display === 'none') {
                form.style.display = 'block';
                btn.style.display = 'none';
            }else{
                form.style.display = 'none';
                btn.style.display = 'block';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
