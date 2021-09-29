<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script type="text/javascrip" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="{{url('/bootstrap.css')}}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        </style>
    </head>
    <body>
        <div>
<?php
    $names = json_decode(file_get_contents("https://api-pub.bitfinex.com/v2/conf/pub:list:currency"),true);
$names = $names[0];

$required = '[
    {
        "crypto_name": 34,
        "conversion_name": "USD"
    },
    {
        "crypto_name": 74,
        "conversion_name": "USD"
    },
    {
        "crypto_name":127,
        "conversion_name": "USD"
    },
    {
        "crypto_name":127,
        "conversion_name": "BTC"
    },
    {
        "crypto_name":74,
        "conversion_name": "BTC"
    }
]';

$required = json_decode($required, true);

echo "<table class=table table-striped table-advance table-hover>";
echo "<tr>";
echo "<th>Symbol</th>";
echo "<th>Last price</th>";
echo "<th>Daily Change</th>";
echo "<th>Change Percent</th>";
echo "<th>Daily high</th>";
echo "<th>Daily low</th>";
echo "</tr>";

for($i = 0; $i < count($required); $i++)
{
    $current_name = $names[$required[$i]["crypto_name"]];
    
    $link = "https://api.bitfinex.com/v1/pubticker/".strtolower($current_name).strtolower($required[$i]["conversion_name"]);
    
    $json_data = json_decode(file_get_contents($link), true);

    $change_percent = 1 - $json_data["low"]/$json_data["high"];
    $change_percent = round($change_percent, 2);
    
    $change = $json_data["high"] - $json_data["low"];
    echo "<tr>";
    echo "<td>".$current_name.$required[$i]["conversion_name"]."</td>";
    echo "<td>".$json_data["last_price"]."</td>";
    echo "<td>".$change."</td>";
    echo "<td>".$change_percent."%</td>";
    echo "<td>".$json_data["high"]."</td>";
    echo "<td>".$json_data["low"]."</td>";
    echo "</tr>";

}
?>
</div>
@include('header')
<button class="btn btn-info">Add to favorites</button>
    </body> 
    
</html>



