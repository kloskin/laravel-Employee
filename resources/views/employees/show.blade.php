<x-employees.layout>
    <x-slot:title>
        Employee
    </x-slot:title>
    <div class="my-14 flex flex-col">
            <div class="text-center">
                <p class="text-gray-500">{{$employee->created_at->format('j M Y')}}</p>

                <h1 class="mb-10 text-6xl font-bold tracking-tighter mt-5">{{ $employee->first_name }} {{ $employee->last_name }}</h1>
                <hr>
            </div>

        <div class="text-center mt-4">
            <h2 class=" text-2xl font-bold tracking-tighter mt-5">Email</h2>
            <p class="text-gray-500  leading-8">
                {{ $employee->email }}
            </p>
            <h2 class=" text-2xl font-bold tracking-tighter mt-5">Phone Number</h2>


            <p class="text-gray-500  leading-8">
                {!! str_replace(',', '<br>', $employee->phone) !!}
            </p>

            <h2 class=" text-2xl font-bold tracking-tighter mt-5">Company</h2>
            <p class="text-gray-500  leading-8">
                @if ($employee->company)
                    {{ $employee->company->name }}
                @else
                    Company is deleted
                @endif
            </p>
            <h2 class=" text-2xl font-bold tracking-tighter mt-5">Dietary preferences</h2>
            <p class="text-gray-500 leading-8">
                @foreach ($employee->dietaryPreferences as $dietary)
                    {{ $dietary->name }}
                    @if (!$loop->last)
                        |
                    @endif
                @endforeach
            </p>
            <div class="flex justify-center mt-8">

                <a href="{{ route('employees.edit', $employee->id) }}" title="edit" class="mr-2 cursor-pointer">
                    <x-employees.images.edit-icon class="w-10 h-10" />
                </a>

                <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" href="{{ route('employees.destroy', $employee->id) }}"
                            onclick="return confirm('Are you sure?')" title="delete" class="cursor-pointer">
                        <x-employees.images.delete-icon class="w-10 h-10" />
                    </button>
                </form>

            </div>
        </div>


        </div>
</x-employees.layout>
