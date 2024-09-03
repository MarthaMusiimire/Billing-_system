<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice {{ $invoice->id }}</h1>
        </div>
        <div class="details">
            @if($invoice)
                <p><strong>Location:</strong> {{ $invoice->client->location ?? 'N/A' }}</p>
                <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
                <p><strong>Due Date:</strong> {{ $invoice->due_date }}</p>
            @else
                <p>Invoice data not available.</p>
            @endif
        </div>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
