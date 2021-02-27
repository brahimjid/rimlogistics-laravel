@extends('app')

@section('content')
    @include('inc.header')
    <div class="my-3 text-center ">
        <h5 class="font-weight-bold">PayRoll</h5>
        <span>({{\Carbon\Carbon::now()->startOfWeek()->format("m-d-yy")}} | {{\Carbon\Carbon::now()->endOfWeek()->format("m-d-yy")}} )</span>

    </div>
    <div class="d-print-none">
        <form id="dateForm" action="{{route('invoices')}}">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="label">From</label>
                        <input type="text" id="date1" name="date1" class="form-control">
                    </div>

                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="label">To</label>
                        <input type="text" class="form-control" name="date2" id="date2">
                    </div>

                </div>

                <div class="col-lg-3 col-md-4  col-sm-6 align-items-center">
                    <div class="form-group">
                        <label class="label">Driver</label>
                        <select class="form-control" name="driver_id" id="driver" searchable="">
                            <option value="" disabled selected></option>
                            @foreach($drivers as $dr)--}}
                            <option value="{{$dr->id}}">{{$dr->full_name}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>

                <div class="col-lg-1 col-md-2 col-sm-6 mt-4">
                    <button class="btn btn-primary btn-md sbmitBtn">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-5 justify-content-center align-items-center">
        <div class="col">
{{--            <div class="table-responsive">--}}

                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="font-weight-bolder">
                        <th scope="col" class="font-weight-bolder">Driver</th>
                        <th scope="col" class="font-weight-bolder">Invoices</th>
                        <th scope="col" class="font-weight-bolder">Fuel</th>
                        <th scope="col" class="font-weight-bolder">check</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    @foreach($data as $k=>$item)
                        @if(count($item[0]['invoices'])>0)
                            <tr>
                                <th rowspan="{{count($item[0]['invoices'])}}" class="font-weight-bold" style="vertical-align : middle" scope="row">{{$k}}</th>
                            @foreach($item[0]['invoices'] as $invoice)

                                    <th scope="row">${{number_format($invoice['amount'],2)}}</th>
                                    @if(isset($item[0]['fuels'][$loop->index]['fuel']))
                                            <th scope="row">${{number_format($item[0]['fuels'][$loop->index]['fuel'],2)}}</th>


                                    @else
                                        <th scope="row"></th>

                                    @endif
                                <th></th>
                                </tr>

                            @endforeach
                                <tr style="border: 2px solid black;font-weight: bold">
                                    <th>Total</th>
                                    <th style="font-weight: bold;">${{number_format($item[0]['sumInvoices'],2)}}</th>
                                    <th style="font-weight: bold">${{number_format($item[0]['sumFuels'],2)}}</th>
                                    <th style="font-weight: bold">
                                        ${{number_format( ( $item[0]['sumInvoices'] - $item[0]['sumFuels'] ) * (1 - 10.5 / 100) ,2)}}
                                    </th>
                                </tr>

                        @endif
                    @endforeach

                    </tbody>
                </table>
                <button class="btn btn-primary d-print-none" onclick="window.print()">Print</button>
            </div>
{{--        </div>--}}

    </div>
@endsection
@section("js")
<script>
    $(document).ready(function () {
        $('.submitBtn').click(function () {
            $('#dateForm').submit();
        })
        $('#date1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment().format('YYYY-MM-DD'),
        });
        $('#date2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment().format('YYYY-MM-DD'),
        });
        $('.mdb-select').materialSelect();

    })
</script>
@endsection
