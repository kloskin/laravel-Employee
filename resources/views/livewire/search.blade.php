<div class="ml-4 relative">
    <label>
        <input wire:model.live="search"
               class="placeholder:italic placeholder:text-slate-400 bg-white w-full border-slate-300 rounded-md py-2 pl-9 pr-3 text-sm md:text-base"
               placeholder="Search for employees ..." type="text" name="search" />
    </label>
    <ul class="absolute w-full">
        @foreach($employees as $employee)
            <a href="{{ route('employees.show', $employee->id) }}">
         <li class="pl-8 pr-2 border-b-2 border-l-2 border-r-2 border-gray-200 relative hover:bg-yellow-100 hover:text-gray-900">
          {{ $employee->first_name }} {{ $employee->last_name }}
         </li>
            </a>
        @endforeach
    </ul>
</div>
