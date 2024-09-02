<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>
<div class="container">
        <div class="header">
            <h1>Verification Successful</h1>
        </div>
        <div class="content">
            <p>Dear {{ $client->client_name }},</p>
            <p>Thank you for verifying your email address. Your account has been successfully verified and is now active.</p>
            <p>If you have any questions or need further assistance, feel free to contact us.</p>
            <p>Best regards,</p>
            <p>Your Company Name</p>
        </div>

    </div>
</body>
</html>