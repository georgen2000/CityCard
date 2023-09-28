<x-app-layout>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __("Update Card Type") }}
                    </h2>
                </header>

                <form method="post" action="{{ route('card_types.update', $card_type->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <!-- Price -->
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" value="{{$card_type->price}}" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- User Category -->
                    <div class="mt-4">
                        <x-input-label for="user_category_id" :value="__('User Category')" />
                        <select name="user_category_id" class="mt-1 block w-full">
                            @foreach ($userCategories as $userCategory)
                            <option value="{{ $userCategory->id }}"
                                @if ($userCategory->id == $card_type->user_category_id)
                                    selected
                                @endif
                            >{{ $userCategory->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('userCategory')" class="mt-2" />
                    </div>

                    <!-- Transport -->
                    <div class="mt-4">
                        <x-input-label for="transport_id" :value="__('Transport')" />
                        <select name="transport_id" class="mt-1 block w-full">
                            @foreach ($transports as $transport)
                            <option value="{{ $transport->id }}"
                                @if ($transport->id == $card_type->transport->id)
                                    selected
                                @endif
                            >{{ $transport->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('transport')" class="mt-2" />
                    </div>

                    <!-- City -->
                    <div class="mt-4">
                        <x-input-label for="city_id" :value="__('City')" />
                        <select name="city_id" class="mt-1 block w-full">
                            @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                                @if ($city->id == $card_type->city->id)
                                    selected
                                @endif
                            >{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>



                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{route('card_types.index')}}" >{{__('Cansel')}}</a>
                        @if (session('status') === 'card-type-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
