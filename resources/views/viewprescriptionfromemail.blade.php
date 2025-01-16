<!-- resources/views/viewprescriptionfromemail.blade.php -->

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
        @if ($prescriptionData && $prescriptionData->lead )
            <h2>Prescription</h2>

            <div class="patient-details">
                @if ($prescriptionData->lead->order->created_at)
                    <p>Date: {{ $prescriptionData->lead->order->created_at->format('d-m-Y') }} </p>
                    <p>Time: {{ $prescriptionData->lead->order->created_at->format('h:i A') }}</p>
                @else
                    <p>Date and Time: Not available</p>
                @endif
                <p>Patient: {{ $prescriptionData->lead->order->shipping_address ?? 'Not available' }}</p>
            </div>

            <div class="prescription-id">
                <p>Prescription #: {{ $prescriptionData->lead->order->id ?? 'Not available' }}</p>
            </div>

            <div class="prescription-details">
                <p>Date: {{ $prescriptionData->lead->order->created_at->format('d-m-Y') }}</p>
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
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUDHANUj39uAkNFw62v59itMBAqpbDLZYft9_Dqei5vFfwlemjVqTxESnbWQ&s"
                alt="signature">
            <br><br><br>

            <div class="patient-details">
                <p><strong>{{ $prescriptionData->lead->first_name }} {{ $prescriptionData->lead->last_name }}</strong></p>
                <p>Date Of Birth: July 12, 1995</p>
            </div>
            <br><br><br><br><br><br>
            <div class="footer">
                <p>Medical Disclaimer: This prescription is for medical purposes only. Please consult with your
                    healthcare
                    professional.</p>
            </div>
        @else
            <p>No prescription data found.</p>
        @endif
    </div>
</body>

</html>
