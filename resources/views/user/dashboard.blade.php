<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
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
                        <x-input-label for="card_type_id" :value="__('Card type')" />
                        <select name="card_type_id" class="mt-1 block w-full">
                            <option value="">--</option>
                            @foreach ($card_types as $card_type)
                                <option value="{{ $card_type->id }}">
                                    City:{{ $card_type->city->name }}\Transport:{{ $card_type->transport->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('card_type_id')" class="mt-2" />
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
    @if ($cards->isNotEmpty())
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                <div style="text-align: center">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __("List of Cards") }}
                    </h3>
                </div>
                <table>
                    <tr>
                        <td>Card Number</td>
                        <td>Card Balance</td>
                        <td>Ticket Price</td>
                        <td>City Name</td>
                        <td>Transport Name</td>
                        <td>Actions</td>
                    </tr>

                    @foreach ($cards as $card)
                    <tr>
                        <td>{{$card->number}}</td>
                        <td>{{$card->balance}}</td>

                            @if (is_null($card->card_type))
                                <td class="red">CARD</td>
                                <td class="red">IS</td>
                                <td class="red">NO ACTIVE</td>
                            @else
                                <td>{{$card->card_type->price}}</td>
                                <td>{{$card->card_type->city->name}}</td>
                                <td>{{$card->card_type->transport->name}}</td>
                            @endif

                        <td>
                            <a href="{{route('history', $card->id)}}">Transactions</a> |
                            <button id="destroy"
                                onclick="card_delete('{{route('cards.destroy', $card->id)}}')";>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </section>
        </div>
    @endif
</x-app-layout>
