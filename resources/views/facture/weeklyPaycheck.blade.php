@extends('app')

@section('content')
    @include('inc.header')
    <h4 class="my-3 text-center font-weight-bold">Weekly payRoll</h4>
    <hr>
    <div class="row mt-5 justify-content-center align-items-center">
        <div class="col">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr class="font-weight-bolder">
                        <th scope="col" class="font-weight-bolder" >Driver</th>
                        <th scope="col" class="font-weight-bolder">Invoices</th>
                        <th scope="col" class="font-weight-bolder">Fuel</th>
                        <th scope="col" class="font-weight-bolder">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoiceData as $driver)
                        <tr>
                            <th scope="row">{{$driver->name}}</th>
                            <th scope="row">${{$driver->invoicesTotal}}</th>
                            <th scope="row">${{$driver->fuel}}</th>
                            <th scope="row">{{$driver->total}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary d-print-none" onclick="window.print()">Print</button>
            </div>
        </div>

    </div>
@endsection
