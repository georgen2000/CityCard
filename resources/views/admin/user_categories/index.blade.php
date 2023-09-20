<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('User_categories') }} / <a href="{{route('user_categories.create')}}" class="">Create</a>
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
        function user_category_delete (url) {
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
    @if ($user_categories)
        <table>
            <tr>
                @foreach (array_keys($user_categories[0]) as $field_name)
                    <td>{{$field_name}}</td>
                @endforeach
                <td>Actions</td>
            </tr>
            @foreach ($user_categories as $user_category)
                <tr>
                    @foreach ($user_category as $name => $field)
                        <td>{{$field}}</td>
                    @endforeach
                    <td>
                        <a href="{{route('user_categories.edit', ['user_category' => $user_category['id']])}}" class="">Edit</a>/
                        <button id="destroy" onclick="user_category_delete('{{route('user_categories.destroy', ['user_category' => $user_category['id']])}}')";>Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-app-layout>
