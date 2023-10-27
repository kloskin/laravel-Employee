<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title ?? null}}</title>

    {{--Scripts--}}

    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .mobile-menu {
            display: none;
        }
        @media (max-width: 1027px) {
            .mobile-menu {
                display: block;
            }

            .desktop-menu {
                display: none;
            }
        }
    </style>


</head>
<body class="font-sans antialiased">
{{--Container for all--}}
<div class="container mx-auto p-10">
    {{--header--}}
    <header class="flex justify-between items-center">
        {{--         logo, search--}}
        <div class="flex items-center">

            <a href="{{url('/')}}"> <x-employees.images.laravel-logo /></a>

            <div class="text-3xl text-gray-600 font-medium ml-2 tracking-tight hidden md:block">
                <a href="{{url('/')}}">LaravelEmployees</a>
            </div>

            <livewire:search />

        </div>
            <!--Nav bar -->
                <ul class="desktop-menu hidden sm:block space-x-4">
                    <li>
                        <div class="text-lg hidden lg:flex space-x-6">
                            <p><a class="inline font-bold text-sm px-10 py-4 text-white rounded-full bg-red-500 hover:bg-red-600" href="{{route('employees.create')}}">Add Employee</a></p>
                        </div>
                    </li>

                </ul>

                <!-- Nawigacja na ekranach mniejszych niż 640px -->
                <div class="mobile-menu">
                    <div id="mobile-menu-button" class="space-y-2 cursor-pointer lg:hidden">
                        <div class="w-8 h-0.5 bg-gray-600"></div>
                        <div class="w-8 h-0.5 bg-gray-600"></div>
                        <div class="w-8 h-0.5 bg-gray-600"></div>
                    </div>

                </div>

    </header>

    <div class="lg:hidden">
        <div id="mobile-menu"
             class="flex-col items-center hidden py-8 mt-10 space-y-6 bg-white left-6 right-6 drop-shadow-lg">
            <a href="{{ route('employees.create') }}"
               class="inline font-bold text-sm px-8 py-4 text-white rounded-full bg-red-500 hover:bg-red-600">
                Add
                employee</a>
        </div>
    </div>

    <script>
        // Obsługa rozwijania i zwijania menu na urządzeniach mobilnych
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle("flex");
        });
    </script>

    {{ $slot }}

    <hr>
    {{--        footer--}}
    <foot class="flex items-center justify-center mt-12">
        &copy; 2023 Filip Kloska
    </foot>
</div>
</body>
</html>
