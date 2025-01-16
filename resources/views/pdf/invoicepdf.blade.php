
@foreach ($leads as $lead )
    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMMERCIAL INVOICE CUM PACKING LIST</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5px; /* Reduced margin */
            font-size: 10px; /* Reduced font size */
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 7px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .invoice-details {
            margin-bottom: 8px;
        }

        .footer {
            text-align: right;
        }

        .additional-details {
            margin-top: 9px;
        }

        img {
            height: 88px;
            width: 150px;
        }
    </style>
</head>

<body>
    <h2>COMMERCIAL INVOICE CUM PACKING LIST</h2>

    <div class="invoice-details">
        <p><strong>Exporter:</strong> MDAAC INTERNATIONAL PRIVATE LIMITED</p>
        <p><strong>Invoice No.:</strong> MI/EXPORT/22-23/361 DTD. </p>
        <p><strong>Address:</strong> 205, SAGAR PLAZA-II, PLOT NO. 27, DDA COMPLEX, ROAD NO.44, PITAMPURA, NEW
            DELHI-110034, INDIA</p>
        <p><strong>IEC:</strong> AAKCM8477E</p>
        <p><strong>GSTIN NO.:</strong> 07AAKCM8477E1Z1</p>
        <p><strong>Email:</strong> billing@mdaac.net</p>
        <p><strong>Tel:</strong> +91 11 43580327</p>
        <hr>
        <p><strong>Consignee:</strong> Aid Access Eloise Arthur</p>
        <p><strong>Attn:</strong>{{ $lead->first_name }} {{ $lead->last_name }}</p>
        <p><strong>Address:</strong> {{ $lead->order->billing_address }}</p>
        <p><strong>Country of Origin of Goods:</strong> INDIA</p>
        <p><strong>Country of Final Destination:</strong> USA</p>
        <p><strong>Pre-Carriage by:</strong> Place of Receipt by Pre Carrier</p>
        <p><strong>Vessel / Voyage:</strong> Port of Loading - NEW DELHI</p>
        <p><strong>Port of Discharge Final Destination:</strong> USA MS USA</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>S. NO.</th>
                <th>Description of Goods</th>
                <th>HSN/SAC</th>
                <th>Gross Weight (Gm)</th>
                <th>Net Weight (Gm)</th>
                <th>Quantity (Unit)</th>
                <th>Unit Price (USD)</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Khushi MT Kit Batch No. 23M014 MFG. 02/2023 EXP. 01/2025</td>
                <td>30049099</td>
                <td>13.5</td>
                <td>10</td>
                <td>1</td>
                <td>20.00</td>
                <td>20.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Khushi Miso 200 Batch No. 23HT056 MFG. 02/2023 EXP. 01/2025</td>
                <td>30049099</td>
                <td>13.5</td>
                <td>4</td>
                <td>1</td>
                <td>10.00</td>
                <td>10.00</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Total No of Packet:</strong> 1</p>
        <p><strong>FOB (In Words):</strong> US Dollars Thirty Only</p>
    </div>

    <p><strong>Declaration:</strong> "We declare that this Invoice shows the actual price of the goods described and
        that all particulars are true and correct".</p>

    <div class="additional-details">
        <p><strong>Bank details:</strong></p>
        <p><strong>BANKER'S NAME:</strong> STATE BANK OF INDIA FOR MDAAC INTERNATIONAL PRIVATE LIMITED</p>
        <p><strong>ADDRESS:</strong> M BLOCK CONNAUGHT CIRCUS, NEW DELHI</p>
        <p><strong>ACCOUNT NAME:</strong> MDAAC INTERNATIONAL PRIVATE LIMITED</p>
        <p><strong>ADDRESS:</strong> 30 HANUMAN LANE, CONNAUGHT PLACE, NEW DELHI-110001, INDIA</p>
        <p><strong>ACCOUNT NO:</strong> 39570820763</p>
        <p><strong>SWIFT NO:</strong> SBININBB701</p>
        <p><strong>AUTHORISED SIGNATORY</strong></p>
        <img class="signature"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUDHANUj39uAkN
    Fw62v59itMBAqpbDLZYft9_Dqei5vFfwlemjVqTxESnbWQ&s"
            alt="signature">
    </div>
<hr>
</body>

</html>
@endforeach