<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label From</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #fff;
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
{{-- {{ dd($data) }} --}}
@foreach($selectedOrderIds as $selectedOrder)
    <div class="address">
        <p>  From : </p>
        <p> MDAAC INTERNATIONAL PVT. LTD.</p>
        <p>205, SAGAR PLAZA-II, PLOT NO. 27, </p>
        <p>PITAMPURA, NEW DELHI-110034, </p>
        <p>INDIA</p>
        
    </div>

    <br><br><br><br>

@endforeach
    

</body>
</html>
