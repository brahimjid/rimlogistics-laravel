<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    --}}
    <title></title>
    <style>

        table, td, th {
            border: 1px solid #dddddd;
            text-align: center;

        }

        table {
            border-collapse: collapse;
            width: 100%;
            page-break-inside: avoid !important;
            /*margin: 100px auto;*/
        }

        th, td {
            padding: 10px;
            page-break-inside: avoid !important;
        }


        .dId {
            border: 2px solid black;
            margin: 20px auto;
            width: 25%;
            height: 50px
        }

        .dIdText {
            font-weight: bold
        }
    </style>
</head>
<body>
<div class="dId">
{{--    {{$driver_id}} --}}
    <p style="text-align: center;">Truck Number : <span class="dIdText">{{$driver}}</span></p>
</div>
{{----}}
<table>

    <tr>
        <th> State </th>
        <th> Distance (mi) </th>
        <th>Fuel (gal)</th>

    </tr>
    @php $fe=0 ;$dis=0;
    @endphp

    @foreach($results as $key=>$items)

        <tr>
            <td>{{$key}}</td>
            @if (count($items) > 1)
                @foreach ($items as $item)
                    @if(isset($item->fuel))
                        @php($fe= $item->fuel);
                    @else

                        @php($dis=$item->distance)
                    @endif
                @endforeach
                <td>{{$dis}}</td>
                <td>{{$fe}}</td>
            @else
                <td>{{$items[0]->distance}}</td>
                <td>0</td>
            @endif
        </tr>
    @endforeach
{{--    @foreach($results as $result)--}}
{{--    <tr>--}}

{{--        <td>{{$result->state}}</td>--}}
{{--        <td>{{$result->distance}}</td>--}}
{{--        <td>{{$result->fuel}}</td>--}}


{{--    </tr>--}}



{{--    @endforeach--}}


</table>

</body>
</html>
