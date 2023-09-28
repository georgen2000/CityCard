<x-app-layout>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('messages.update_user', [
                            'name' => $user->name,
                            'id' => $user->id,
                        ]) }}
                    </h2>
                </header>

                <form method="post" action="{{ route('users.update', $user->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" value="{{ $user->name }}" type="text"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email-->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" value="{{ $user->email }}" type="email"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                        <x-text-input id="phone_number" name="phone_number" value="{{ $user->phone_number }}"
                            type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- User Category -->
                    <div class="mt-4">
                        <x-input-label for="user_category_id" :value="__('User Category')" />
                        <select name="user_category_id" class="mt-1 block w-full">
                            @foreach ($userCategories as $userCategory)
                                <option value="{{ $userCategory->id }}"
                                    @if ($userCategory->id == $user->user_catergory_id)
                                        selected
                                    @endif>
                                    {{ $userCategory->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('userCategory')" class="mt-2" />
                    </div>

                    <!-- Is Admin -->
                    <div>
                        <x-input-label for="is_admin" :value="__('Is Admin')" />
                        <input id="is_admin" name="is_admin" type="checkbox" class="mt-1 block" value=1
                            {{ $user->is_admin ? 'checked' : '' }} />
                        <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{ route('users.index') }}">{{ __('Cansel') }}</a>
                        @if (session('status') === 'user-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
