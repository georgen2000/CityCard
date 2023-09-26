<x-app-layout>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __("Create Card Type") }}
                    </h2>
                </header>

                <form method="post" action="{{ route('card_types.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <!-- Price -->
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- User Category -->
                    <div class="mt-4">
                        <x-input-label for="user_category_id" :value="__('User Category')" />
                        <select name="user_category_id" class="mt-1 block w-full">
                            <option value="">--</option>
                            @foreach ($user_categgoties as $user_category)
                            <option value="{{ $user_category->id }}">{{ $user_category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_category')" class="mt-2" />
                    </div>

                    <!-- Transport -->
                    <div class="mt-4">
                        <x-input-label for="transport_id" :value="__('Transport')" />
                        <select name="transport_id" class="mt-1 block w-full">
                            <option value="">--</option>
                            @foreach ($transports as $transport)
                            <option value="{{ $transport->id }}">{{ $transport->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('transport')" class="mt-2" />
                    </div>

                    <!-- City -->
                    <div class="mt-4">
                        <x-input-label for="city_id" :value="__('City')" />
                        <select name="city_id" class="mt-1 block w-full">
                            <option value="">--</option>
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>



                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{route('card_types.index')}}" >{{ __('Cansel') }}</a>
                        @if (session('status') === 'card-type-created')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Created.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
