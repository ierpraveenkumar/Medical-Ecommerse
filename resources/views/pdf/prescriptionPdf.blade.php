<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #9cbe98;

        }

        .margn {
            margin-left: 30px;
            margin-right: 55px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #4af307;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #a84040;
        }

        h2 {
            text-align: center;
        }

        .patient-details {
            margin-bottom: 20px;
        }

        .prescription-details {
            margin-bottom: 20px;
        }

        .signature {
            width: 150px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .prescription-id {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="margn">
        @foreach ($leads as $lead)
            <h2>Prescription</h2>

            <div class="patient-details">
                <p>Date: {{ $lead->order->created_at->format('d-m-Y') }} </p>
                <p>Time:{{ $lead->order->created_at->format('h:i A') }}</p>
                <p>Patient: </p>
                <p>{{ $lead->order->shipping_address }}</p>
            </div>

            <div class="prescription-id">
                <p>Prescription #: {{ $lead->order->id }}</p>
            </div>

            <div class="prescription-details">
                <p>Date: {{ $lead->order->created_at->format('d-m-Y') }}</p>
                <br><br><br>
                <p><strong>R/MifePristone 200mg</strong></p>
                <p>Dtd: 1 tablet</p>
                <p>S: as indicated</p>
                <br><br><br>

                <p><strong>R/Misopristol 200mg</strong></p>
                <p>Dtd: 12 tablets</p>
                <p>S: as indicated</p>
            </div>

            <img class="signature"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUDHANUj39uAkN
                    Fw62v59itMBAqpbDLZYft9_Dqei5vFfwlemjVqTxESnbWQ&s"
                alt="signature">
            <br><br><br>

            <div class="patient-details">
                <p><strong>{{ $lead->first_name }} {{ $lead->last_name }}</strong></p>
                <p>Date Of Birth: July 12, 1995</p>
            </div>
            <br><br><br><br><br><br>
            <div class="footer">
                <p>Medical Disclaimer: This prescription is for medical purposes only. Please consult with your
                    healthcare
                    professional.</p>
            </div>

            {{ '-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------' }}
        @endforeach
    </div>
</body>

</html>
