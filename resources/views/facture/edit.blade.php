@extends('app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
@endsection
@section('content')
    <!-- Material form contact -->
    <div class="card mt-5 mx-auto col-lg-6 col-sm-12
">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Add invoice</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">


            <!-- Extended material form grid -->
            <form method="post" action="{{route('invoice.update')}}">
                @method('put')
            @csrf
            <!-- Grid row -->
                <div class="form-row">
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <input type="text" class="form-control" value="{{$facture->fact_num}}" required id="num" name="num">
                            <label for="num">Invoice #</label>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <input type="number" class="form-control" value="{{$facture->amount}}" required name="amount" id="inputPassword4MD">
                            <label for="inputPassword4MD">Amount</label>
                        </div>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->

                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <input type="text" value="{{$facture->date}}" class="form-control" required name="date" id="date">
                            <label for="inputAddressMD">Date</label>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <select class="mdb-select md-form" name="driver_id" id="driver" searchable="">
                            <option value="{{$facture->driver->id}}" selected>{{$facture->driver->full_name}}</option>
                        </select>
                        <label for="driver">Driver</label>
                    </div>
                    <!-- Grid column -->
                </div>
                <div>
{{--                    <select name="extra" class="mdb-select md-form">--}}
{{--                        <option value="{{$facture->extra}}" selected>--}}
{{--                            @if($facture->extra ==0)--}}
{{--                                no--}}
{{--                            @endif--}}
{{--                        </option>--}}
{{--                        <option value="1">no</option>--}}
{{--                    </select>--}}
                </div>
                <input type="hidden" name="id" value="{{$facture->id}}">
                <button type="submit" class="btn btn-primary btn-md">update</button>
            </form>

        </div>

    </div>

    <!-- Material form contact -->
@endsection
@section('js')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                {{--defaultDate:@php echo $facture->date @endphp ,--}}
            });
            $('.mdb-select').materialSelect();

        })
    </script>
@endsection
