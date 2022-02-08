@extends('layouts.app')
@section('page_title')
<span>PaymentReceived Report </span>
@endsection
@section('content')
<div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">Serial</th>
                <th class="col-md-2">Received By</th>
                <th class="col-md-2">Customer Name</th>
                <th class="col-md-2">Madthod Name</th>
                <th class="col-md-2">Invoice</th>
                <th class="col-md-2">Amount</th>
            </tr>
        </thead>

        <tbody>
            {{dd($payments)}}

            {{-- {{dd($payment)}}; --}}
              <tr>
                  @foreach ($payment as $Payments)
                <td>{{ $loop->iteration }}</td>
                {{-- @foreach ($payments as $paymenti)
                <td>{{$paymenti->user}}</td>
                @endforeach --}}

                <td>{{$Payments->user->name}}</td>
                <td>{{$Payments->paymentMethod->name}}</td>
                <td>{{$Payments->Invoice->invoice_number}}</td>
                <td>{{$Payments->amount}}</td>

                </tr>
                @endforeach


        </tbody>
    </table>
</div>
@endsection
