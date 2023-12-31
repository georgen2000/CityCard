<x-app-layout>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('messages.update_city', [
                            'name' => $city->name,
                            'id' => $city->id,
                        ]) }}
                    </h2>
                </header>

                <form method="post" action="{{ route('cities.update', $city->id) }}" enctype="multipart/form-data"
                    class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" value="{{ $city->name }}" type="text"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    @if (empty($city->getFirstMedia()))
                        <img style="height: 200px;" src="{{ $city->getFirstMediaUrl() }}" alt="{{ __('Emblem') }}">
                    @else
                        <img style="height: 200px;" src="{{ $city->getFirstMediaUrl() }}" alt="{{ __('Emblem') }}">
                        <div>
                            <x-input-label for="delete_img" :value="__('Delete Image')" />
                            <input type="checkbox" name="delete_img" value=1>
                        </div>
                        {{__('Or Change Image')}}
                    @endif
                    <div>
                        <x-input-label for="emblem" :value="__('Emblem')" />
                        <input id="emblem" name="emblem" type="file">
                        <x-input-error :messages="$errors->get('emblem')" class="mt-2" />
                    </div>


                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        <a href="{{ route('cities.index') }}">{{ __('Cansel') }}</a>
                        @if (session('status') === 'city-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
