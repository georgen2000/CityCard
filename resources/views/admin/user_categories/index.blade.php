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
    @if ($user_categories->isNotEmpty())
        <table>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Actions</td>
            </tr>
            @foreach ($user_categories as $user_category)
                <tr>
                    <td>{{ $user_category->id }}</td>
                    <td>{{ $user_category->name }}</td>
                    <td>
                        <a href="{{route('user_categories.edit', $user_category->id)}}">Edit</a>/
                        <a onclick="user_category_delete('{{route('user_categories.destroy', $user_category->id)}}')">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-app-layout>
