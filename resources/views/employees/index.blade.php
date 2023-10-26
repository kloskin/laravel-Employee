<x-employees.layout>

        <x-slot:title>
            All employees
        </x-slot:title>

    <div class="my-14">
        <h1 class="text-6xl tracking-tighter font-bold mb-6">Employees</h1>
        <hr/>
    </div>

    <livewire:sort />

    <br>

        {{$employees->links()}}

</x-employees.layout>
