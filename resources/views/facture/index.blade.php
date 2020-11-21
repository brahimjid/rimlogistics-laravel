@extends('app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
@endsection
@section('content')
      @include('inc.header')

    <h4 class="my-3 text-center font-weight-bold">Daily invoices report</h4>
    <hr>
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

    <div class="row mt-5">
        <div class="col">
{{--            <div class="table-responsive text-nowrap">--}}
                  <div class="table-responsive">
                      <table class="table text-center">
                          <thead>
                          <tr class="font-weight-bolder">
                              <th scope="col" style="width: 15%" class="font-weight-bolder"> #</th>
                              <th scope="col" style="width: 15%" class="font-weight-bolder">Amount</th>
                              <th scope="col" style="width: 20%" class="font-weight-bolder">Date</th>
                              <th scope="col" style="width: 40%" class="font-weight-bolder">Driver</th>
                              <th scope="col" style="width: 10%" class="font-weight-bolder">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($factures as $facture)

                              <tr>
                                  <th scope="row">{{$facture->fact_num}}</th>
                                  <th>${{number_format($facture->amount,2)}}</th>
                                  <th>{{\Carbon\Carbon::parse($facture->date)->toDateString()}}</th>
                                  <th>
                                      @if(isset($facture->driver->full_name))
                                          {{$facture->driver->full_name}}
                                          <span class="font-weight-bold">({{$facture->driver->truck_number}})</span>
                                      @else
                                      @endif
                                  </th>
                                  <th scope="row" class="d-print-none">

                                      <div class="d-flex flex-column justify-content-between">
                                          <button  class="btn btn-info btn-sm">
                                              <a class="text-white" href="{{route('invoice.edit',$facture->id)}}">Edit</a>
                                          </button>
                                          <button data-id="{{$facture->id}}" class="btn btn-danger btn-sm d-inline delete">
                                              Delete
                                          </button>
                                      </div>


                                  </th>


                              </tr>
                          @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <th class="font-weight-bold">
                                  Total
                              </th>
                              <th colspan="4" class="font-weight-bold">
                                  ${{number_format($factures->sum('amount',2))}}
                              </th>

                          </tr>
                          </tfoot>
                      </table>
                  </div>

                <button class="btn btn-primary d-print-none" onclick="window.print()">Print</button>
        </div>
        @include('inc.dMd')

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
            });
            $('#date2').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment().format('YYYY-MM-DD'),
            });
            $('.mdb-select').materialSelect();

            $('.delete').click(function () {
                let id = $(this).data('id');
                $('#deleteMd').modal('show');
                $('.confirmD').click(function () {
                    //console.log('id'+id)
                    $.ajax({
                        url: '{{route('invoice.delete')}}',
                        method: 'post',
                        data: {id},
                        success: function (data) {
                            if (data === true)
                                location.reload()
                            else
                                alert('error');
                        }
                    });
                })
            })
        })
    </script>


@endsection
