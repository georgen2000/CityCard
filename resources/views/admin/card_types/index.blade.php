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
    @if ($card_types->isNotEmpty())
        <table>
            <tr>
                <td>Id</td>
                <td>Ticket Price</td>
                <td>User Categoty Name</td>
                <td>Transport Name</td>
                <td>City Name</td>
                <td>Actions</td>
            </tr>
            @foreach ($card_types as $card_type)
                <tr>
                    <td>{{$card_type->id}}</td>
                    <td>{{$card_type->price}}</td>
                    <td><a href="{{ route('user_categories.edit', $card_type->user_category->id) }}">
                        {{$card_type->user_category->name}}
                    </a></td>
                    <td><a href="{{ route('transports.edit', $card_type->transport->id) }}">
                        {{$card_type->transport->name}}
                    </a></td>
                    <td><a href="{{ route('cities.edit', $card_type->city->id) }}">
                        {{$card_type->city->name}}
                    </a></td>

                    <td>
                        <a id="action" href="{{route('card_types.edit', $card_type->id)}}" class="">Edit</a>/
                        <a id="destroy" onclick="card_type_delete('{{route('card_types.destroy',  $card_type->id)}}')";>Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</x-app-layout>
