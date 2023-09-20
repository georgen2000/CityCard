<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Card_types') }} / <a href="{{route('card_types.create')}}" class="">Create</a>
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

        }

        a#action {
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
        function card_type_delete (url) {
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
    @if ($card_types)
        <table>
            <tr>
                @foreach (array_keys($card_types[0]) as $field_name)
                    <td>{{$field_name}}</td>
                @endforeach
                <td>Actions</td>
            </tr>
            @foreach ($card_types as $card_type)
                <tr>
                    @foreach ($card_type as $name => $field)
                        @if (is_array($field))
                            <td><a href="{{ $field['href'] }}">{{ $field['name'] }}</a></td>
                        @else
                            <td>{{$field}}</td>
                        @endif
                    @endforeach
                    <td>
                        <a id="action" href="{{route('card_types.edit', ['card_type' => $card_type['id']])}}" class="">Edit</a>/
                        <button id="destroy" onclick="card_type_delete('{{route('card_types.destroy', ['card_type' => $card_type['id']])}}')";>Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</x-app-layout>
