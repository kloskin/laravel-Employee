<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title ?? null}}</title>

    {{--Scripts--}}

    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
            .desktop-menu {
                margin-left: 10px;
            }
            .button-nav{
                text-align: center;
                justify-content: center;
                display: flex;
                /*font-size: 10px;*/

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
                <ul class="desktop-menu">
                    <li>
                        <div class="">
                            <p><a class="button-nav inline font-bold text-xs md:text-base px-4 py-4 text-white rounded-full bg-red-500 hover:bg-red-600" href="{{route('employees.create')}}">Add Employee</a></p>
                        </div>
                    </li>

                </ul>

    </header>

    {{ $slot }}

    <hr>
    {{--        footer--}}
    <foot class="flex items-center justify-center mt-12">
        &copy; 2023 Filip Kloska
    </foot>
</div>
</body>
</html>
