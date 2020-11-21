@extends('app')
@section('css')
@endsection
@section('content')

    <div class="container">

        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-lg-10 col-md-10 col-sm-12 ">
                <div class="card">

                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>upload here</strong> <br>
                    </h5>

                    <div class="card-body px-lg-5 pt-0">

                        <div class="md-form">
                            <form class="md-form" action="{{ route('import') }}" method="POST"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="file-field">
                                    <div class="btn btn-outline-primary waves-effect btn-sm float-left">
                                            <span>Choose file<i class="fas fa-cloud-upload-alt ml-3"
                                                                aria-hidden="true"></i></span>
                                        <input type="file" name="file" required>
                                    </div>
                                    <div class="file-path-wrapper ">
                                        <input class="file-path validate text-primary" placeholder="please choose the excel file you downloaded fro pilotJ website" type="text">
                                    </div>
                                </div>


                                         <button class="btn btn-primary
                                              btn-rounded mx-auto d-block z-depth-0 my-4 waves-effect"
                                                 type="submit" id="uploadBtn">
                                             Upload
                                         </button>


                                <div class="progress mt-5" id="progressCnt">
                                    <div class="progress md-progress" style="height: 20px">
                                        <div class="progress-bar" role="progressbar" style="width: 0%; height: 20px"
                                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div id="success">

                                </div>
                            </form>
                        </div>



                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="list-group mb-3" id="driversList">
                                @foreach($drivers as $driver)
                                    <div class="list-group-item">
                                        <span  class="font-weight-bold">{{$driver->full_name}}</span>
                                        <a class="btn btn-success btn-sm float-right text-decoration-none" href="{{route('export',$driver->truck_number)}}"> Download </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/jquery.form.min.js')}}"></script>
    <script>
        $(document).ready(function () {
           let driverList = $("#driversList").hide(),
               progressBar =   $('.progress-bar');
            $('.progress').hide();
            $('#downloadBtn').hide();
            $('form').ajaxForm({
                beforeSend: function () {
                    $('#success').empty();
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $('.progress').show()
                    progressBar.text(percentComplete + '%');
                    progressBar.css('width', percentComplete + '%');
                },
                success: function (data) {

                    if (data === true) {
                        $('#uploadBtn').remove();
                        //   $('.progress-bar').text('Uploaded');
                        progressBar.css('width', '100%');


                        driverList.show();
                        $("#progressCnt").hide();
                        // $('#success').text('file uploaded');

                    }
                }
            });

        });
    </script>
    </script>
@endsection
