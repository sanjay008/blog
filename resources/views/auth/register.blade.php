<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Middle Name -->
        <div class="mt-4">
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" autocomplete="middle_name" />
            <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" autocomplete="dob" />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <div class="flex items-center">
                <input type="radio" name="gender" value="male" id="male" class="mr-2" @if(old('gender') == 'male') checked @endif>
                <label for="male">{{ __('Male') }}</label>

                <input type="radio" name="gender" value="female" id="female" class="mx-4" @if(old('gender') == 'female') checked @endif>
                <label for="female">{{ __('Female') }}</label>

                <input type="radio" name="gender" value="other" id="other" class="ml-4" @if(old('gender') == 'other') checked @endif>
                <label for="other">{{ __('Other') }}</label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Hobbies -->
        <div class="mt-4">
            <x-input-label for="hobbies" :value="__('Hobbies')" />
            <div class="flex items-center">
                <input type="checkbox" name="hobbies[]" value="Reading" id="reading" class="mr-2" @if(in_array('Reading', old('hobbies', []))) checked @endif>
                <label for="reading">{{ __('Reading') }}</label>

                <input type="checkbox" name="hobbies[]" value="Sports" id="sports" class="mx-4" @if(in_array('Sports', old('hobbies', []))) checked @endif>
                <label for="sports">{{ __('Sports') }}</label>

                <input type="checkbox" name="hobbies[]" value="Music" id="music" class="mx-4" @if(in_array('Music', old('hobbies', []))) checked @endif>
                <label for="music">{{ __('Music') }}</label>

                <input type="checkbox" name="hobbies[]" value="Traveling" id="traveling" class="ml-4" @if(in_array('Traveling', old('hobbies', []))) checked @endif>
                <label for="traveling">{{ __('Traveling') }}</label>
            </div>
            <x-input-error :messages="$errors->get('hobbies')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Profile Image -->
        <div class="mt-4">
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <x-text-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" />
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full">
                <option value="user" @if(old('role') == 'user') selected @endif>{{ __('User') }}</option>
                <option value="admin" @if(old('role') == 'admin') selected @endif>{{ __('Admin') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

 

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

