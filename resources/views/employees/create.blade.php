<x-employees.layout>
    <x-slot:title>
        Create employee
    </x-slot:title>
    <div class="my-14">
        <h1 class="text-4xl">New Employee</h1>
        <div class="w-full">
            <form method="POST" action="{{ route('employees.store') }}"
                  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-6 grid md:grid-cols-2 md:gap-6">
                    <div class="mb-6 md:mb-0">
                        <label class="block text-gray-700 font-bold mb-2" for="employee-firstName">
                            First name
                        </label>
                        <input required name="first_name"
                               class="shadow appearance-none border {{$errors->first('first_name') ? 'border-red-500' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline"
                               id="employee-firstName" type="text" placeholder="Write your first name here" value="{{old('first_name')}}">
                        <p class="text-red-500 text-xs italic">{{$errors->first('first_name')}}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2" for="employee-lastName">
                            Last Name
                        </label>
                        <input required name="last_name"
                               class="shadow appearance-none border {{$errors->first('last_name') ? 'border-red-500' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline"
                               id="employee-lastName" type="text" placeholder="Write your last name here" value="{{old('last_name')}}">
                        <p class="text-red-500 text-xs italic">{{$errors->first('last_name')}}</p>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="employee-email">
                        Email
                    </label>
                    <input required name="email"
                           class="shadow appearance-none border {{$errors->first('email') ? 'border-red-500' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline"
                           id="employee-email" type="email" placeholder="Write your email here" value="{{old('email')}}">
                    <p class="text-red-500 text-xs italic">{{$errors->first('email')}}</p>
                </div>


                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="employee-company">
                        Company
                    </label>

                    <select name="company_id" class="border  text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                        @foreach ($allCompanies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                    <p class="text-red-500 text-xs italic">{{$errors->first('company')}}</p>
                </div>
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold mb-2" for="employee-dietary">
                        Dietary preferences
                    </label>
                </div>

                <button id="dropdownSearchButton" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-gray-500 rounded-lg hover:bg-gray-700 " type="button">Choose  <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg></button>

                <div class="mb-6">
                    <div id="dropdownSearch" class="z-10  hidden bg-white rounded-lg shadow w-60 ">
                        <div class="p-3">
                        </div>
                        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700" aria-labelledby="dropdownSearchButton">
                            @foreach ($dietaryPreferences as $preference)
                                <li>
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100">
                                        <input name="dietary[]" type="checkbox" value="{{ $preference->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"  {{ in_array($preference->id, old('dietary', [])) ? 'checked' : '' }}>
                                        <label for="dietary" class="w-full ml-2 text-sm font-medium text-gray-700 rounded">{{ $preference->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <p class="text-red-500 text-xs italic">{{$errors->first('dietary')}}</p>
                </div>


                <p class="hidden">{{$i=0}}</p>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="phone-input">
                        Phone
                    </label>
                    <div id="additional-phone-fields" >
                        @if (count(old('phone', [])) > 0)
                            @foreach(old('phone') as $phoneNumber)
                                <input type="text" name="phone[]" class="form-control shadow appearance-none border {{$errors->first('phone.'.$loop->index) ? 'border-red-500' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" value="{{ $phoneNumber }}" placeholder="Write your phone number">
                                <p id="errorDelete_{{$loop->index}}" class="text-red-500 text-xs italic mb-4">{{$errors->first('phone.'.$loop->index) ? 'Wrong number' : null}}</p>
                                <p class="hidden">{{$i++}}</p>
                            @endforeach
                        @else
                            <input type="text" name="phone[]" class="form-control shadow appearance-none border {{$errors->first('phone.'.$i) ? 'border-red-500' : null}} rounded-lg w-full py-2 px-3 text-gray-700 mb-6 leading-tight focus:outline-none focus:shadow-outline" placeholder="Write your phone number">
                        @endif
                    </div>


                    <input type="hidden" id="phone-field-count" name="phone-field-count" value="{{ count(old('phone', [])) }}">
                    <button type="button" id="add-phone-field" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-gray-500 rounded-lg hover:bg-gray-700 ">Add next phone number</button>
                    <button type="button" id="delete-phone-field" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-700 ">Delete last phone number</button>

                </div>


                <br><br>
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold text-lg py-2 rounded-lg cursor-pointer"
                        type="submit">
                    Add employee
                </button>
            </form>
        </div>
    </div>

</x-employees.layout>
