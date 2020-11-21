<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">--}}
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
        .dIdText{
            font-weight: bold
        }
    </style>
</head>
<body>
<div class="dId">
    <p style="text-align: center;">Truck Number : <span class="dIdText">{{$driver_id}}</span></p>
</div>

<table>
    <tr>
        <th>State</th>
        <th>Card(s)</th>
        <th>Quantity</th>
    </tr>

    @foreach($res as $state=>$re)
        <tr>
            <td rowspan="2">{{$state}}</td>
            <td>00{{$re[0][0]}}</td>
            <td>{{$re[0]['total']}}</td>

        </tr>


        <tr>
            @if(count($re)>1)
                <td style="margin-top: 5px;">00{{$re[1][0]}}</td>
                <td>{{$re[1]['total']}}</td>
            @else
                <td style="border-right: 1px solid #ddd;
                    border-top: 2px solid
                    white;">

                </td>
                <td style="border-right: 1px solid #ddd;
                    border-top: 2px solid
                    white;"></td>
            @endif
        </tr>


    @endforeach


</table>


</body>
</html>
