import './bootstrap';

import Alpine from 'alpinejs';

window.openScanner = function () {

    console.log('openScanner')

    // This method will trigger user permissions
    Html5Qrcode.getCameras().then(devices => {
        /**
         * devices would be an array of objects of type:
         * { id: "id", label: "label" }
         */
        if (devices && devices.length) {

            let extraConfig = devices[0].id;

            if (devices.length > 1) {
                extraConfig = {facingMode: "environment"};
            }

            const html5QrCode = new Html5Qrcode(/* element id */ "reader");
            html5QrCode.start(
                extraConfig,
                {
                    fps: 10,    // Optional frame per seconds for qr code scanning
                    qrbox: 250  // Optional if you want bounded box UI
                },
                qrCodeMessage => {
                    // do something when code is read
                    // alert(qrCodeMessage);

                    let parts = qrCodeMessage.split("*");

                    openNewTransaction({
                        transaction: {
                            id: null
                        },
                        category: {
                            id: 4,
                            name: 'Храна',
                            color: {
                                hex: '#b47b55',
                            },
                            icon: {
                                filename: 'grocery.svg'
                            }
                        },
                        amount: parts['4'],
                        date: parts['2'],
                        note: 'Billa'
                    })
                    // manageQrTransaction(walletID,qrCodeMessage)

                    html5QrCode.stop();
                    html5QrCode.clear();
                },
                errorMessage => {
                    // parse error, ignore it.
                })
                .catch(err => {
                    // Start failed, handle it.
                });

        }
    }).catch(err => {
        // handle err
    });

}

window.openNewTransaction = function (fill = {}) {
    console.log('openNewTransaction');

    const data = {
        open: true,
        title: 'Add new transaction',
        button: 'Create',
        transaction: {
            id: null,
            category: {
                id: null,
                name: '',
                type: '',
                color: {
                    hex: '',
                },
                icon: {
                    filename: ''
                }
            },
            amount: '',
            date: '',
            note: ''
        },
        deleteTransaction() {
        },
        submit() {
            console.log(this.transaction)
            fetch(params.createTransactionUri, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    _token: document.head.querySelector('meta[name=csrf-token]').content,
                    amount: this.transaction.amount,
                    category_type: this.transaction.category.type,
                    category_id: this.transaction.category.id,
                    note: this.transaction.note,
                    date: this.transaction.date,
                    wallet_id: params.walletID,
                })
            }).then(function (response) {
                if (response.ok) {
                    return response.text();
                }

                throw new Error('Something went wrong.');
            }).then(function (text) {
                console.log('Request successful', text);
                location.reload();
            }).catch(function (error) {
                console.log('Request failed', error);
                alert(error.message);
            });
        }
    };

    if (Object.keys(fill).length !== 0) {
        data.transaction = fill;
    }

    populateModal(data)
}

window.openEditTransaction = function (data) {
    console.log("openEditTransaction")
    populateModal(data)
}

window.populateModal = function (data) {
    console.log('populateModal');

    let event = new CustomEvent("update-transaction-modal", {
        detail: {
            openIncome: false,
            showCategories: false,
            openExpense: false,
            open: true,
            title: data.title,
            button: data.button,
            transaction: data.transaction,
            deleteTransaction: data.deleteTransaction,
            submit: data.submit,
        }
    });

    window.dispatchEvent(event);

}

window.contactForm = function () {
    return {
        transaction: {
            id: null,
            category: {
                id: null,
                name: 'Test',
                type: '',
                color: {
                    hex: '#ccc',
                },
                icon: {
                    filename: 'car.svg'
                }
            },
            amount: '',
            date: '',
            note: '',
        },
        title: '',
        button: '',
        open: false,
        showCategories: false,
        openIncome: false,
        openExpense: false,
        deleteTransaction() {
        },
        submit() {
            alert('submit init');
        },
        updateDate(data) {
            this.transaction.date = data.date;
        },
        updateData(data) {
            this.button = data.button;
            this.showCategories = data.showCategories;
            this.openIncome = data.openIncome;
            this.openExpense = data.openExpense;
            this.open = data.open;
            this.title = data.title;
            this.deleteTransaction = data.deleteTransaction;
            this.submit = data.submit;
            this.transaction = data.transaction;
        }
    }

}

const pickerElementDate = document.getElementById('date_field');
if (typeof (pickerElementDate) != 'undefined' && pickerElementDate != null) {
    const picker = new Litepicker({
        element: pickerElementDate,
        singleMode: true,
        setup: (picker) => {
            picker.on('before:show', () => {
                if (pickerElementDate.value.length < 4) {
                    return;
                }
                picker.setDate(new Date(pickerElementDate.value));
            });

            picker.on('selected', (date1) => {
                pickerElementDate.value = formatDate(date1.dateInstance);

                let event = new CustomEvent("update-transaction-date", {
                    detail: {
                        date: formatDate(date1.dateInstance),
                    }
                });

                window.dispatchEvent(event);
            });
        },
    });
}

function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

const pickerElement = document.getElementById('litepicker');

if (typeof (pickerElement) != 'undefined' && pickerElement != null) {
    const date = new Date();

    const clone = (date) => {
        return new Date(date)
    }

    const thisMonth = (date) => {
        const d1 = clone(date);
        d1.setDate(1);
        const d2 = new Date(date.getFullYear(), date.getMonth() + 1, 0);

        return [d1, d2];
    };

    const lastMonth = (date) => {
        const d1 = clone(date);
        d1.setDate(1);
        d1.setMonth(date.getMonth() - 1);
        const d2 = new Date(date.getFullYear(), date.getMonth(), 0);

        return [d1, d2];
    };

    const yesterday = (date) => {
        const d1 = clone(date);
        return new Date(d1.setDate(date.getDate() - 1));
    }

    const getRelativeDayInWeek = (d, dy, dx = 0) => {
        const d1 = clone(d);
        let day = d1.getDay(),
            diff = d1.getDate() - day + (day === 0 ? -6 : dy) - dx; // adjust when day is sunday
        return new Date(d1.setDate(diff));
    }

    const customRanges = {
        'Today': [clone(date), clone(date)],
        'Yesterday': [yesterday(date), yesterday(date)],
        'This week': [getRelativeDayInWeek(date, 1), getRelativeDayInWeek(date, 7)],
        'Last week': [getRelativeDayInWeek(date, 1, 7), getRelativeDayInWeek(date, 7, 7)],
        'This month': thisMonth(date),
        'Last month': lastMonth(date),
        'This year': [new Date(date.getFullYear(), 0, 1), new Date(date.getFullYear(), 12, 0)],
        'Last year': [new Date(date.getFullYear() - 1, 0, 1), new Date(date.getFullYear() - 1, 12, 0)],
        'All': [new Date(1971, 0, 1), new Date(date.getFullYear(), 12, 0)]
    };

    const picker = new Litepicker({
        startDate: new Date(params.litepicker.start),
        endDate: new Date(params.litepicker.end),
        element: pickerElement,
        plugins: ['ranges'],
        ranges: {
            customRanges: customRanges,
            position: 'right'
        },
        singleMode: false,
        numberOfMonths: 2,
        numberOfColumns: 2,
        setup: (picker) => {
            picker.on('selected', (date1, date2) => {

                let startDate = formatDate(date1.dateInstance);
                let endDate = formatDate(date2.dateInstance);

                document.getElementById('start_date').value = startDate;
                document.getElementById('end_date').value = endDate;
                document.getElementById('filter_form').submit();

            });
        },
    });
}

window.Alpine = Alpine;
Alpine.start();
