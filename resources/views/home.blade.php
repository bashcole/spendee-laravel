<x-app-layout>
    <div class="py-6 sm:px-6 lg:px-8">
        <div>
            <h3 class="text-2xl leading-6 font-medium text-gray-900">
                @translate('Overview')
                @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </h3>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">

                <div class="px-4 py-5 bg-white rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        @translate('Total Balance')
                    </dt>
                    <dd class="mt-1 text-xl font-semibold @if($totals['balance'] > 0)text-green-400 @else text-red-400 @endif">
                        {{ $totals['balance'] > 0 ? '+' : '' }}{{ number_format($totals['balance'], 2) }} {{ auth()->user()->showCurrency() }}
                    </dd>
                </div>

                <div class="px-4 py-5 bg-white rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        @translate('Total Expenses')
                    </dt>
                    <dd class="mt-1 text-xl font-semibold text-red-400">
                        -{{ number_format($totals['totalExpenses'], 2) }} {{ auth()->user()->showCurrency() }}
                    </dd>
                </div>

                <div class="px-4 py-5 bg-white rounded-lg overflow-hidden sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        @translate('Total Income')
                    </dt>
                    <dd class="mt-1 text-xl font-semibold text-green-400">
                        {{ $totals['totalIncome'] > 0 ? '+' : '' }}{{ number_format($totals['totalIncome'], 2) }} {{ auth()->user()->showCurrency() }}
                    </dd>
                </div>

            </dl>

        </div>
    </div>

    <div class="py-6 sm:px-6 lg:px-8">

        <div>
            <div class="flex items-center justify-between">
                <h3 class="text-2xl leading-6 font-medium text-gray-900">@translate('Wallets')</h3>
                <button
                    class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:w-auto sm:text-sm"
                    type="button">@translate('Add New Wallet')</button>
            </div>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">

                @foreach($wallets as $wallet)
                    <a href="{{ route('wallet.view', ['locale'=> app()->getLocale(), 'wallet' => $wallet->id]) }}"
                       class="transition-all duration-150 transform px-4 py-5 bg-white rounded-lg overflow-hidden sm:p-6 hover:scale-105 hover:shadow-xl">
                        <dt class="text-md font-medium text-gray-500 truncate mb-5">
                            {{ $wallet->name }}
                        </dt>
                        <dd class="mt-1 text-2xl font-semibold @if($wallet->balance > 0)text-green-400 @else text-red-400 @endif">
                            {{ number_format($wallet->balance, 2) }} {{ $wallet->currency->alphabeticCode }}
                        </dd>
                        @if ($wallet->currency->alphabeticCode != 'BGN')
                            <dd class="mt-1 text-md font-semibold text-gray-400">
                                {{ $wallet->convertToBgn($wallet->balance) }} BGN
                            </dd>
                        @endif
                    </a>
                @endforeach

            </dl>
        </div>

    </div>

</x-app-layout>
