<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Create Card') }}
                    </h3>
                </div>
                @if (isset($cities))
                    <form method="get" action="{{ route('cards.create') }}" class="mt-6 space-y-6">
                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />
                            <select name="city" class="mt-1 block w-full">
                                <option value="">--</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Next') }}</x-primary-button>
                        </div>
                    </form>
                @else
                    <form method="post" action="{{ route('cards.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />
                            <select name="city" class="mt-1 block w-full">
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Transport -->
                        <div class="mt-4">
                            <x-input-label for="transport" :value="__('Transport')" />
                            <select name="transport" class="mt-1 block w-full">
                                <option value="">--</option>
                                @foreach ($transports as $transport)
                                    <option value="{{ $transport->id }}">
                                        {{ $transport->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('transport')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                            @if (session('status') === 'card-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Created.') }}</p>
                            @endif
                        </div>
                    </form>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
