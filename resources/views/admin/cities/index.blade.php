<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Cities') }} / <a href="{{ route('cities.create') }}" class="">{{ __('Create') }}</a>
        </h2>
    </x-slot>
    @if ($cities->isNotEmpty())
        <table>
            <tr>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>
                        <a href="{{ route('cities.edit', $city->id) }}">{{ __('Edit') }}</a>/
                        <button id="destroy" onclick="delete_db_obj('{{ route('cities.destroy', $city->id) }}')">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="width: 60%; margin:auto; padding: 15px">
            {{ $cities->render() }}
        </div>
    @endif

</x-app-layout>
