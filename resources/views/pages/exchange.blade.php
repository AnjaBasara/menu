@extends('index')
@section('content')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">

        <div class="mb-5">To purchase a currency, please choose the desired currency and the amount you would like to
            purchase.
        </div>

        <form method="POST" autocomplete="off" id="form">
            @csrf

            <div class="form-group row align-items-center">
                <label for="currency" class="col-md-6 col-form-label text-md-right">Currency to purchase:</label>
                <div class="col-md-6">
                    <select id="currency" name="currency" class="custom-select" required>
                        <option selected disabled hidden value="">Select currency</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="amount" class="col-md-6 col-form-label text-md-right">Amount:</label>
                <div class="col-md-6">
                    <input id="amount" type="number" name="amount" class="form-control" required>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center p-3" id="priceDiv">
                <div>Purchase price:</div>
                <h4 id="price"></h4>
            </div>

            <div class="form-group row d-flex justify-content-center" id="purchaseDiv">
                <button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('currency').addEventListener('click', calculatePrice);
        document.getElementById('amount').addEventListener('input', calculatePrice);

        function calculatePrice() {
            const currencyID = document.getElementById('currency').value;
            const amount = document.getElementById('amount').value;

            if (currencyID && amount) {
                getPrice(currencyID, amount);
                show('priceDiv');
                show('purchaseDiv');
            } else {
                hide('priceDiv');
                hide('purchaseDiv');
            }
        }

        function getPrice(currencyID, amount) {
            const form_data = new FormData();
            form_data.append('currencyID', currencyID);
            form_data.append('amount', amount);

            $.ajax({
                type: 'POST',
                url: '/calculate',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: form_data,
                processData: false,
                contentType: false,
                success:
                    function (price) {
                        document.getElementById('price').innerText = price + ' USD';
                    },
                error:
                    function (error) {
                        console.log(error);
                    },
            });
        }

        function show(id) {
            document.getElementById(id).style.visibility = 'visible';
        }

        function hide(id) {
            document.getElementById(id).style.visibility = 'hidden';
        }
    </script>
@endpush
