<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} / <a href="{{route('cards.create')}}"> {{ __('Create Card')}} </a>
        </h2>
    </x-slot>
    @if ($cards->isNotEmpty())
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl" style="margin: auto">

                <section>
                    <div style="text-align: center">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Filters') }}
                        </h3>
                    </div>
                    <form method="get" action="{{ route('dashboard') }}" class="mt-6 space-y-6">
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
                            <x-input-error :messages="$errors->get('cardType_id')" class="mt-2" />
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
                            <x-input-error :messages="$errors->get('cardType_id')" class="mt-2" />
                        </div>

                        <div class="flex justify-between gap-4">
                            <x-primary-button>{{ __('Filtrate') }}</x-primary-button>
                            <a href="{{ route('dashboard') }}">{{ __('Cansel') }}</a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                <div style="text-align: center">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('List of Cards') }}
                    </h3>
                </div>
                <table>
                    <tr>
                        <td>{{ __('Card Number') }}</td>
                        <td>{{ __('Card Balance') }}</td>
                        <td>{{ __('Ticket Price') }}</td>
                        <td>{{ __('City') }}</td>
                        <td>{{ __('Transport') }}</td>
                        <td>{{ __('Actions') }}</td>
                    </tr>

                    @foreach ($cards as $card)
                        <tr>
                            <td>{{ $card->number }}</td>
                            <td>{{ $card->balance }}</td>

                            @if (is_null($card->cardType))
                                <td class="red">{{ __('CARD') }}</td>
                                <td class="red">{{ __('IS') }}</td>
                                <td class="red">{{ __('NO ACTIVE') }}</td>
                            @else
                                <td>{{ $card->cardType->price }}</td>
                                <td>{{ $card->cardType->city->name }}</td>
                                <td>{{ $card->cardType->transport->name }}</td>
                            @endif
                            <td>
                                <?php $temp = route('cards.destroy', ['card' => $card->id]); ?>

                                <a href="{{ route('history', ['card' => $card->id]) }}">{{ __('Transactions') }}</a> |
                                <button id="destroy" onclick="delete_db_obj('{{ $temp }}')";>
                                    {{ __('Delete') }}
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div style="width: 60%; margin:auto; padding: 15px">
                    {{ $cards->render() }}
                </div>
            </section>
        </div>

    @endif
</x-app-layout>
