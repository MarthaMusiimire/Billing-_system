<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #4CAF50;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .email-container p {
            margin: 10px 0;
        }

        .verify-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #4CAF50;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        .verify-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>{{ $mailData['title'] }}</h1>
        <p>{{ $mailData['body'] }}</p>


        <p>Thank you for registering with us. We are excited to have you on board.</p>
        <p>Please click on the verify button below to verify your email.</p>  
        <form action="{{ route('client.verify', ['id', 'hash']) }}" method="GET">
            <button type="submit" class="btn btn-submit">Verify Email</button>
        </form>

        <p>Thank you</p><br><br>
    </div>
</body>

</html>
