@extends('app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
@endsection
@section('content')
    <!-- Material form contact -->
    <div class="card mt-5 mx-auto col-lg-6 col-sm-12
">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Add Fuel</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">


            <!-- Extended material form grid -->
            <form method="post" action="{{route('fuel.store')}}">
            @csrf
            <!-- Grid row -->
                <div class="form-row">
                    <!-- Grid column -->
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-12">
                        <!-- Material input -->
                        <div class="md-form form-group">
                            <input type="text" class="form-control" required name="amount" id="inputPassword4MD">
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
                            <input type="text" class="form-control" required name="date" id="date">
                            <label for="inputAddressMD" id="label">Date</label>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-6">
                        <!-- Material input -->
                        <select class="mdb-select md-form" name="driver_id" id="driver" required searchable="">
                            <option value="" disabled selected></option>
                            @foreach($drivers as $dr)--}}
                            <option value="{{$dr->id}}">
                                  {{$dr->full_name}}
                                 <span class="font-weight-bold">({{$dr->truck_number}})</span>
                            </option>
                            @endforeach
                        </select>
                        <label for="driver">Driver</label>
                    </div>
                    <!-- Grid column -->
                </div>

                <button type="submit" class="btn btn-primary btn-md">Sign in</button>
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
                defaultDate: moment(),
            });
            $("#label").addClass('active')
            $('.mdb-select').materialSelect();

        })
    </script>
@endsection
