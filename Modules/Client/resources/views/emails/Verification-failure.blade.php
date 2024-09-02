<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="header">
            <h1>Verification Failed</h1>
        </div>
        <div class="content">
        <p>Dear {{ $client->client_name }},</p>
            <p>Unfortunately, we were unable to verify your email address. Please try the verification process again.</p>
            <p>If you continue to experience issues, please contact our support team for assistance.</p>
            <p>Best regards,</p>
            <p>Your Company Name</p>
        </div>
        
    </div>
    
</body>
</html>