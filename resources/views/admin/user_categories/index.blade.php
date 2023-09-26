<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('User Categories') }} / <a href="{{ route('user_categories.create') }}"
                class="">{{ __('Create') }}</a>
        </h2>
    </x-slot>
    @if ($user_categories->isNotEmpty())
        <table>
            <tr>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Actions') }}</td>
            </tr>
            @foreach ($user_categories as $user_category)
                <tr>
                    <td>{{ $user_category->id }}</td>
                    <td>{{ $user_category->name }}</td>
                    <td>
                        <a href="{{ route('user_categories.edit', $user_category->id) }}">{{ __('Edit') }}</a>/
                        <button id="destroy"
                            onclick="delete_db_obj('{{ route('user_categories.destroy', $user_category->id) }}')">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-app-layout>
