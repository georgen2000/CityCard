<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Cities') }} / <a href="{{route('cities.create')}}" class="">Create</a>
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
        function city_delete (url) {
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
    @if ($cities)
        <table>
            <tr>
                @foreach (array_keys($cities[0]) as $field_name)
                    <td>{{$field_name}}</td>
                @endforeach
                <td>Actions</td>
            </tr>
            @foreach ($cities as $city)
                <tr>
                    @foreach ($city as $name => $field)
                        <td>{{$field}}</td>
                    @endforeach
                    <td>
                        <a href="{{route('cities.edit', ['city' => $city['id']])}}" class="">Edit</a>/
                        <button id="destroy" onclick="city_delete('{{route('cities.destroy', ['city' => $city['id']])}}')";>Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-app-layout>
