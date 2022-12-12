<x-app-layout >

    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <x-transaction-modal id="transaction_modal" :categories="$categories"/>
    <h3 class="text-lg leading-6 font-medium text-gray-900 my-5">{{ $wallet->name }}</h3>

    <div x-data="" class="flex items-baseline md:items-center md:justify-between flex-col md:flex-row">
        <div class="flex flex-col md:block">
            <button @click="openNewTransaction()"
                    class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:w-auto sm:text-sm"
                    type="button"> @translate('Add Transaction')
            </button>
            <button @click="openScanner()"
                    class="mt-4 md:mt-0 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:w-auto sm:text-sm"
                    type="button"> @translate('QR Scan')
            </button>
        </div>

    </div>
    <div class="py-6">

        <div style="width: 100%" ;>
            <div style="width: 500px; margin: 0 auto;" id="reader"></div>
        </div>

        @foreach($transactions as $month => $monthTransactions)
            <div class="">
                <div class="bg-white overflow-hidden sm:rounded-lg mb-10 px-4 py-4 sm:px-6">
                    <div class="flex my-1">
                        <span class="flex-1 text-lg leading-6 font-medium text-gray-900">{{ $month }}</span>
                        <span class="text-lg leading-6 font-medium text-gray-300">{{ $wallet->sumTransactions($monthTransactions) }}  {{ $wallet->currency->alphabeticCode }}</span>
                    </div>

                    <div class="divide-y divide-gray-200 " x-data="">
                        @foreach($monthTransactions as $transaction)
                            <div @click="openEditTransaction({{ $transaction->toObject() }})" class="block py-2">
                                <div class="flex px-4 py-4 sm:px-6 rounded-lg hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div style="background-color: {{ $transaction->category->color->hex }};"
                                             class="mr-4 font-bold text-gray-700 rounded-full flex justify-center font-mono">
                                            <img class=" h-15 w-15 text-white"
                                                 src="{{ asset('images/icons/' . $transaction->category->icon->filename) }}"
                                                 alt="Category icon"/>
                                        </div>
                                    </div>

                                    <div class="flex flex-grow">

                                        <div class="flex w-60 items-center">
                                            {{ $transaction->category->name }}
                                        </div>

                                        <div class="flex w-60 flex-col">
                                            <div>
                                                {{ $transaction->format() }}
                                            </div>
                                            <div class="text-gray-400">
                                                {{ $transaction->ago() }}
                                            </div>
                                        </div>

                                        <div class="flex flex-grow flex-1 items-center">
                                            @if ($transaction->note)
                                                {{ $transaction->note }}
                                            @else
                                                --
                                            @endif
                                        </div>

                                    </div>

                                    <div
                                        class="flex @if ($transaction->negative()) text-red-400 @else text-green-400 @endif">
                                        {{ $transaction->moneyFormatWithSign() }}
                                        {{ $wallet->currency->alphabeticCode }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <script>
        let params = {
            litepicker: {
                start: '{{$start ?? '' }}',
                end: '{{$end ?? '' }}',
            },
            createTransactionUri: '{{ route('transaction.store', app()->getLocale()) }}',
            walletID: {{ $wallet->id }}
        }
    </script>
</x-app-layout>
