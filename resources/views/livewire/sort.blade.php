
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
        <tr>
            <th scope="col" class="px-6 py-3" wire:click="sortBy('first_name')">
                <a href="#">
                    <div class="flex items-center">
                        First Name
                        <x-employees.images.sort-icon  />
                    </div>
                </a>
            </th>
            <th scope="col" class="px-6 py-3" wire:click="sortBy('last_name')">
                <a href="#">
                    <div class="flex items-center">
                        Last Name
                        <x-employees.images.sort-icon  />
                    </div>
                </a>
            </th>
            <th scope="col" class="px-6 py-3" wire:click="sortBy('email')">
                <a href="#">
                    <div class="flex items-center">
                        Email
                        <x-employees.images.sort-icon  />
                    </div>
                </a>
            </th>
            <th scope="col" class="px-6 py-3" wire:click="sortBy('name')">
                <a href="#">
                    <div class="flex items-center">
                        Company
                        <x-employees.images.sort-icon  />
                    </div>
                </a>
            </th>
            <th scope="col" class="px-6 py-3" wire:click="sortBy('first_name')">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>

        <tbody>
        @foreach($employees as $employee)
            <tr class="bg-white border-b">
                <td class="px-6 py-4 ">
                    {{$employee->first_name}}
                </td>
                <td class="px-6 py-4">
                    {{$employee->last_name}}
                </td>
                <td class="px-6 py-4">
                    {{$employee->email}}
                </td>
                <td class="px-6 py-4">
                    @if ($employee->company)
                        {{ $employee->company->name }}
                    @else
                        Company is deleted
                    @endif
                </td>
                <td class="px-6 py-4 text-right ">
                    <div class="flex justify-end">

                        <a href="{{ route('employees.show', $employee) }}"> <x-employees.images.info-icon /></a>

                        <a href="{{ route('employees.edit', $employee) }}" title="edit" class="mr-10 cursor-pointer">
                            <x-employees.images.edit-icon class="w-7 h-7" />
                        </a>

                        <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" href="{{ route('employees.destroy', $employee) }}"
                                    onclick="return confirm('Are you sure?')" title="delete" class="cursor-pointer">
                                <x-employees.images.delete-icon class="w-7 h-7" />
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



