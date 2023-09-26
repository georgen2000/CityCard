<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Card Types') }} / <a href="{{ route('card_types.create') }}" class="">{{ __('Create') }}</a>
        </h2>
    </x-slot>
    @if ($card_types->isNotEmpty())
        <table>
            <tr>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Ticket Price') }}</td>
                <td>{{ __('User Category') }}</td>
                <td>{{ __('Transport') }}</td>
                <td>{{ __('City') }}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
            @foreach ($card_types as $card_type)
                <tr>
                    <td>{{ $card_type->id }}</td>
                    <td>{{ $card_type->price . __('UAH') }} </td>
                    <td><a href="{{ route('user_categories.edit', $card_type->usercategory->id) }}">
                            {{ $card_type->usercategory->name }}
                        </a></td>
                    <td><a href="{{ route('transports.edit', $card_type->transport->id) }}">
                            {{ $card_type->transport->name }}
                        </a></td>
                    <td><a href="{{ route('cities.edit', $card_type->city->id) }}">
                            {{ $card_type->city->name }}
                        </a></td>

                    <td>
                        <a id="action" href="{{ route('card_types.edit', $card_type->id) }}"
                            class="">{{ __('Edit') }}</a>/
                        <button id="destroy"
                            onclick="delete_db_obj('{{ route('card_types.destroy', $card_type->id) }}')">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</x-app-layout>
