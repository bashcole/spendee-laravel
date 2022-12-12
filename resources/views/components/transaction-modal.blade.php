<!-- This example requires Tailwind CSS v2.0+ -->
<div x-cloak x-data="contactForm()" @update-transaction-date.window="updateDate($event.detail)"
     @update-transaction-modal.window="updateData($event.detail)" x-show="open"
     class="fixed z-10 inset-0 overflow-y-auto"
     aria-labelledby="modal-title" role="dialog" aria-modal="true" id={{$id}}>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
             aria-hidden="true" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div x-show="open"
             class="inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <form autocomplete="off" action="/" method="POST" @submit.prevent="submit">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 x-text="title" class="text-lg leading-6 font-medium text-gray-900"
                                id="modal-title"></h3>
                            <div class="mt-2">

                                <div class="md:grid md:grid-cols-4 md:gap-4 sm:flex sm:flex-col">

                                    <div>

                                        <label for="category_id" class="block text-sm font-medium text-gray-700 my-4">Category</label>

                                        <template x-if="transaction.category.id">
                                            <div>
                                                <div @click="showCategories = !showCategories"
                                                     class="flex items-center justify-between">
                                                    <div
                                                        x-bind:style="'background-color: ' + transaction.category.color.hex"
                                                        class="flex-shrink-0 mr-4 font-bold text-gray-700 rounded-full flex items-center justify-center font-mono">
                                                        <img class="h-15 w-15 text-white"
                                                             x-bind:src="'{{ asset('images/icons/') }}/' + transaction.category.icon.filename"/>
                                                    </div>
                                                    <span x-text="transaction.category.name"></span>
                                                </div>
                                            </div>
                                        </template>

                                        <div x-show="!transaction.category.id" class="flex">
                                            <span @click="showCategories = !showCategories" class="mt-2 block">Избери категория</span>
                                        </div>

                                        <input id="category_id" x-model="transaction.category.id" autocomplete="off"
                                               type="hidden" name="category_id"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <input id="category_type" x-model="transaction.category.type" autocomplete="off"
                                               type="hidden" name="category_type"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                                        <div x-show="showCategories" class="mt-2"
                                             style="border-radius: 4px; z-index: 9999; position: absolute; border: 1px solid rgb(204, 204, 204); background-color: rgb(255, 255, 255); padding: 10px;">
                                            <div class="flex mb-2">
                                                <span @click="openIncome = true;openExpense = false;"
                                                      class="w-full cursor-pointer inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">Income</span>
                                                <span @click="openIncome = false;openExpense = true;"
                                                      class="w-full cursor-pointer inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Expense</span>
                                            </div>

                                            <div class="flex flex-col" x-show="openIncome">
                                                @foreach($categories['income'] as $category)
                                                    <div
                                                        @click="showCategories = false;transaction.category = {{ $category }}"
                                                        class="m-2 flex items-center justify-between">
                                                        <div style="background-color: {{ $category->color->hex }}"
                                                             class="mr-4 font-bold text-gray-700 rounded-full flex items-center justify-center font-mono">
                                                            <img class=" h-15 w-15 text-white"
                                                                 src="{{ asset('images/icons/' . $category->icon->filename) }}"/>
                                                        </div>
                                                        <span class="flex-1">{{ $category->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="flex flex-col max-h-60 overflow-y-scroll" x-show="openExpense">
                                                @foreach($categories['expense'] as $category)
                                                    <div
                                                        @click="showCategories = false;transaction.category = {{ $category }}"
                                                        class="m-2 flex items-center justify-between">
                                                        <div style="background-color: {{ $category->color->hex }}"
                                                             class="mr-4 font-bold text-gray-700 rounded-full flex items-center justify-center font-mono">
                                                            <img class=" h-15 w-15 text-white"
                                                                 src="{{ asset('images/icons/' . $category->icon->filename) }}"/>
                                                        </div>
                                                        <span class="flex-1">{{ $category->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                    </div>

                                    <div>
                                        <label for="date"
                                               class="block text-sm font-medium text-gray-700 my-4">Date</label>
                                        <input id="date_field" x-model="transaction.date" autocomplete="off" type="text"
                                               name="date" id="city"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="note"
                                               class="block text-sm font-medium text-gray-700 my-4">Note</label>
                                        <input x-model="transaction.note" autocomplete="off" type="text" name="note"
                                               id="note"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div>
                                        <label for="amount"
                                               class="block text-sm font-medium text-gray-700 my-4">Amount</label>
                                        <input x-model="transaction.amount" autocomplete="off" type="text" name="amount"
                                               id="amount" autocomplete="postal-code"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <span id="amount_error"></span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                    <button x-text="button" type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"></button>

                    <template x-if="transaction.id">
                        <button type="button" @click="deleteTransaction"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </template>

                </div>
            </form>

        </div>
    </div>
</div>
