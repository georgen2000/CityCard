<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Transports') }} / <a href="{{route('transports.create')}}" class="">Create</a>
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
        function transport_delete (url) {
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
    @if ($transports->isNotEmpty())
        <table>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Actions</td>
            </tr>
            @foreach ($transports as $transport)
                <tr>
                    <td>{{ $transport->id }}</td>
                    <td>{{ $transport->name }}</td>
                    <td>
                        <a href="{{route('transports.edit', $transport->id)}}">Edit</a>/
                        <a onclick="transport_delete('{{route('transports.destroy', $transport->id)}}')">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-app-layout>
