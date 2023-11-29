<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f8f8; border: 1px solid #ddd;">

        <h2 style="color: #333;">Email Verification</h2>

        <p>Hello,</p>

        <p>Thank you for registering on our website. Please use the following code to verify your email address:</p>

        <p style="font-size: 24px; font-weight: bold; color: #007BFF;">{{ $code }}</p>

        <p>Visit <a href={{ $link }} style="color: #007BFF; text-decoration: none;">Click Me!</a> to
            input the code and complete the verification process.</p>

        <p>If you did not sign up for our website, please ignore this email.</p>

        <p>Best regards,<br>EventPulse Team</p>

    </div>

</body>

</html>
