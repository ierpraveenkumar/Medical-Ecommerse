@foreach ($leads as $lead )
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label To</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #799685;
        }

        

        .address {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="address">
        <p>To:</p>
        <p>{{ $lead->first_name }} {{ $lead->last_name }}</p>
        <p>C/O Evan Franklin</p>
        <p>{{ $lead->order->shipping_address }}</p>
        <p>PH 2107630193</p>
    </div>
    <br><br><br><br>
       
</body>


</html>



@endforeach