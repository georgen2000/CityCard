<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center">
            {{ __('Transactions') }}
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
    @if ($transactions->isNotEmpty())
        @foreach ($transactions as $trans)
            <div style="text-align: center"><p>
                Time: {{$trans->created_at}}
                &emsp; Balance: {{$trans->is_spending ? "-" . $trans->money_count : "+" . $trans->money_count}} грн
            </p></div>
        @endforeach
    @endif

</x-app-layout>
