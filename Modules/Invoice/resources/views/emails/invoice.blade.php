<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }
        .content {
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice </h1>
        </div>
        <div class="content">
            <p>Dear {{ $invoice->client->client_name }},</p>
            <p>We hope this email finds you well. Please find your invoice attached below:</p>
            <ul>
                <li><strong>Invoice ID:</strong> 1</li>
                <li><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</li>
                <li><strong>Due Date:</strong> {{ $invoice->due_date}}</li>
            </ul>
            <p>If you have any questions or concerns regarding this invoice, please do not hesitate to contact us.</p>
            <p>Thank you for your business!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
