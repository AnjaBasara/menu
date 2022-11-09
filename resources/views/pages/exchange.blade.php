@extends('index')
@section('content')
    <div class="h-100 d-flex flex-column justify-content-center align-items-center">

        <div class="mb-5">To purchase a currency, please choose the desired currency and the amount you would like to purchase.</div>

        <form method="POST"  autocomplete="off">
            @csrf

            <div class="form-group row">
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

            <div class="form-group row d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Purchase</button>
            </div>
        </form>
    </div>
@endsection
