@extends('app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
@endsection
@section('content')
    <div class="row mt-5 justify-content-between align-items-center">
        <div class="clo-8">


            <div class="col-12 mb-2">
                <h2 class="text-uppercase text-primary font-weight-bolder">Rimlogistics llc</h2>
            </div>
            <div class="col-12 mb-2">
                <span class="font-weight-bold">Address : </span>
                <span>10007 Olympics Circle Indianapolis IN 46234</span>
            </div>
            <div class="col-12 mb-2">
                <span class="font-weight-bold mr-2 mt-2">Tel:</span>
                <span>3178000112</span>
            </div>
            <div class="col-12">
                <span class="font-weight-bold mr-2">Email:</span>
                <span>operations@rimlogistics.me</span>
            </div>
        </div>


        <div class="col-4">
            <div class="col-12">
                <h4 class="font-weight-bold mr-2 d-inline">Date:</h4>
                <span>{{\Carbon\Carbon::now()->toDateString()}}</span>
            </div>
        </div>
    </div>
    <h4 class="my-3 text-center font-weight-bold">Daily invoices report</h4>
    <hr>
    <div class="d-print-none w-75  mx-auto">
        <form id="dateForm" action="{{route('fuel')}}">
            @csrf
            <div class="row justify-content-center align-items-center">

                <div class="col-lg-4 ">
                    <label class="label">From</label>
                    <input type="text" id="date1" name="date1" class="form-control">
                </div>

                <div class="col-lg-4">
                    <label class="label">To</label>
                    <input type="text" class="form-control" name="date2" id="date2">
                </div>
                <div class="col-2 mt-4">
                    <button class="btn btn-primary btn-md sbmitBtn">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-5">
        <div class="col justify-content-center align-items-center">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr class="font-weight-bolder">
                        <th scope="col" class="font-weight-bolder">Amount</th>
                        <th scope="col" class="font-weight-bolder">Date</th>
                        <th scope="col" class="font-weight-bolder">Driver</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fuels as $fuel)

                        <tr>
                            <th scope="row">${{number_format($fuel->fuel,2)}}</th>
                            <th scope="row">{{\Carbon\Carbon::parse($fuel->created_at)->toDateString()}}</th>
                            <th scope="row">

                                    {{$fuel->driver->full_name}}

                                    <span class="font-weight-bold">({{$fuel->driver->truck_number}})</span>
                            </th>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button class="btn btn-primary d-print-none" onclick="window.print()">Print</button>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.submitBtn').click(function () {
                $('#dateForm').submit();
            })
            $('#date1').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment().format('YYYY-MM-DD'),
            }); $('#date2').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment().format('YYYY-MM-DD'),
            });
            $('.mdb-select').materialSelect();

        })
    </script>


@endsection
