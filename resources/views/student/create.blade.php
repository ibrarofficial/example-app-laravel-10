<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Student') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <x-success-status class="mb-4" :status="session('message')" />
                {{--<x-validation-errors  class="mb-4" :errors=$errors />--}}

                <form action="{{route('student.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Student Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                       autofocus/>
                        @error('name')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Student Email')"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                      :value="old('email')"  autofocus/>
                        @error('email')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Student Phone')"/>
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                      :value="old('phone')"  autofocus/>
                        @error('phone')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="avatar" :value="__('Student Photo')"/>
                        <x-text-input id="avatar" class="block mt-1 w-full" type="file" name="avatar"/>
                        @error('avatar')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <x-primary-button class="ms-3">
                        {{ __('Save Student') }}
                    </x-primary-button>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
