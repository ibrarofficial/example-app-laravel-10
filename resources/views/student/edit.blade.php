<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4 px-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <x-success-status class="mb-4" :status="session('message')" />

                <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Student Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$student->name"
                                      autofocus/>
                        @error('name')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Student Email')"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                      :value="$student->email"  autofocus/>
                        @error('email')
                        <div class="font-medium text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Student Phone')"/>
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                      :value="$student->phone"  autofocus/>
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
                        @if($student->avatar)
                            <br><img src="{{ asset('storage/avatars/'.$student->avatar) }}" style="height: 100px;width:100px;"></div>
                        @else
                            <span>No photo found!</span>
                        @endif
                    </div>
                    <x-primary-button class="ms-3">
                        {{ __('Update Student') }}
                    </x-primary-button>

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
