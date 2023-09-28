<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <form method="get" action="{{ route('users.index') }}">
                <div style="display: flex; justify-content: space-between">
                    <div>
                        <x-input-label for="search" :value="__('Search By Name')" />
                        <x-text-input id="search" name="search" type="text"
                            value="{{ request()->input('search') }}" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('search')" class="mt-2" />
                    </div>
                    <div style="display: flex;
                                align-items: center;
                                justify-content: space-around;
                                width: 40%;">
                        <a href="{{ route('users.index') }}">{{ __('Cansel') }}</a>
                        <x-primary-button>{{ __('Search') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </main>
    <main>
        @if ($users->isNotEmpty())
            <table>
                <tr>
                    <td>{{ __('ID') }}</td>
                    <td>{{ __('Name') }}</td>
                    <td>{{ __('Email') }}</td>
                    <td>{{ __('Phone Number') }}</td>
                    <td>{{ __('User Category') }}</td>
                    <td>{{ __('Is Admin') }}</td>
                    <td>{{ __('Actions') }}</td>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->userCategory->name }}</td>
                        <td>{{ $user->is_admin }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}">{{ __('Edit') }}</a>/
                            <button id="destroy" onclick="delete_db_obj('{{ route('users.destroy', $user->id) }}')">
                                {{ __('Delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div style="width: 60%; margin:auto; padding: 15px">
                {{ $users->render() }}
            </div>
        @else
            <div style="text-align:center">
                <p style="margin: auto; width: 10%" class="red"> {{ __('NO VALUE') }}
                <p>
            </div>
        @endif

</x-app-layout>
