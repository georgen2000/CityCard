<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style type="text/css">
        main {
            margin-top: 30px;
        }
        table {
            width: 60%; /* Ширина таблицы */
            border: 1px solid; /* Рамка вокруг таблицы */
            margin: auto; /* Выравниваем таблицу по центру окна  */
        }
        td {
            padding: 10px;
            border: 1px solid;
            text-align: center; /* Выравниваем текст по центру ячейки */
        }
        a, #destroy {
            color: blue;
            text-decoration: none;
            text-transform: uppercase;
        }

        a:hover, #destroy:hover {
            color: red;
        }

        a:active {
            color: black;
        }

        a:visited {
            color: goldenrod;
        }
    </style>
    <script type="text/javascript">
        function card_delete (url) {
            $.ajax({
                type: "DELETE",
                url: url,
                data:{ _token: "{{ csrf_token()}}"},
                success: function(html){
                    location.reload();
                }
            });
        }
    </script>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl" style="margin: auto">
            <section>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __("Create Card") }}
                    </h3>
                </div>
                <form method="post" action="{{ route('cards.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <!-- Card type -->
                    <div class="mt-4">
                        <x-input-label for="card_type" :value="__('Card type')" />
                        <select name="card_type_id" class="mt-1 block w-full">
                            <option value="">--</option>
                            @foreach ($card_types as $card_type)
                            <option value="{{ $card_type['id'] }}">
                                City:{{ $card_type['city'] }}\Transport:{{ $card_type['transport'] }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_category')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Create') }}</x-primary-button>
                        @if (session('status') === 'card-created')
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
    @if ($cards)
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                <div style="text-align: center">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __("List of Cards") }}
                    </h3>
                </div>
                <table>
                    <tr>
                        @foreach (array_keys($cards[0]) as $field_name)
                            <td>{{$field_name}}</td>
                        @endforeach
                        <td>Actions</td>
                    </tr>
                    @foreach ($cards as $card)
                        <tr>
                            @foreach ($card as $name => $field)
                                <td>{{$field}}</td>
                            @endforeach
                            <td>
                                <a href="{{route('history', ['card' => $card['id']])}}">Transactions</a> |
                                <button id="destroy" onclick="card_delete('{{route('cards.destroy', ['card' => $card['id']])}}')";>Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </section>
        </div>
    @endif
</x-app-layout>
