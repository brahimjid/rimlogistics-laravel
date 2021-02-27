<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

</head>
<style>
    .primary {
        color: #064D8F;
    }

    .secondary {
        color: #666;
    }

    .info {
        color: #607F9C;
    }

    .uppercase {
        text-transform: uppercase;
    }

    .small {
        font-size: 12px;
        text-transform: uppercase;
    }

    .center {
        text-align: center;
    }

    .facture {
        margin: 40px;
        border: 1px solid #f5f3f3;
        border-radius: 10px;
        /*box-shadow: 0 0 2px rgb(226, 216, 216);*/
    }

    .card .row {
        /*display: flex;*/
        /*justify-content: space-between;*/
        padding: 30px;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 16px;
    }
    thead tr {
        border-bottom: 1px solid #E0E0E0;
    }
    tbody tr{
        border-bottom: 1px solid #E0E0E0;
    }
    .space-between {
        /*display: flex;*/
        /*justify-content: space-between;*/
    }

</style>
<body>
<div class="facture">
    <div class="card">
        <div class="row">
            <div class="col">
                <img src="logo.png" width="100" height="100" alt="logo"/>
            </div>
            <div class="col">

            </div>
        </div>

        <h2 class="uppercase center secondary">facture</h2>
        <h4 class="uppercase center primary">facture num: 98kd</h4>
        <div class="row">
            <div class="col">
                <p class="small uppercase primary">importe par</p>
                <p class="uppercase" style="line-height: 25px">
                    joikcar sarl <br/>
                    <span class="info">
                d'ALMEIDA <br/>
                Cyrus .R.A.O <br/>
                60 30 11 44
              </span>
                </p>
                <p class="small uppercase primary">ifu:</p>
                <p style="line-height: 5px">56099089876</p>
            </div>
            <div class="col" style="text-align: right">
                <p class="small uppercase primary">vendu a par</p>
                <p class="uppercase" style="line-height: 25px">
                    jimmy lebuyer <br/>
                    <span class="info">
                benin <br/>
                n986432 <br/>
                66009776
              </span>
                </p>
                <p class="small uppercase primary">date</p>
                <p style="line-height: 5px">Apr 23, 2018</p>
            </div>
        </div>

        <div class="row">
            <div class="col" style="width: 100%">
                <table style="width: 100%">

                    <tr class="uppercase secondary space-between">
                        <th>numero de chassis</th>
                        <th>marque</th>
                        <th>annee</th>
                        <th>prix de vente</th>
                    </tr>

                    <tr class="space-between">
                        <td>4870987707777</td>
                        <td>lexus</td>
                        <td>2016</td>
                        <td>30.000 CFA</td>
                    </tr>

                    <tr class="total" style="text-align: right;font-weight: bolder;">
                        <td colspan="4">34.300 CFA</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
