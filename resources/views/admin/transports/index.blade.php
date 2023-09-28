<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Transports') }} / <a href="{{ route('transports.create') }}" class="">{{ __('Create') }}</a>
        </h2>
    </x-slot>
    @if ($transports->isNotEmpty())
        <table>
            <tr>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
            @foreach ($transports as $transport)
                <tr>
                    <td>{{ $transport->id }}</td>
                    <td>{{ $transport->name }}</td>
                    <td>
                        <a href="{{ route('transports.edit', $transport->id) }}">{{ __('Edit') }}</a>/
                        <button id="destroy"
                            onclick="delete_db_obj('{{ route('transports.destroy', $transport->id) }}')">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="width: 60%; margin:auto; padding: 15px">
            {{ $transports->render() }}
        </div>
    @endif

</x-app-layout>
