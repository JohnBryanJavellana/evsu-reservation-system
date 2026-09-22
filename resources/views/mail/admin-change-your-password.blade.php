<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        color: #333333;
        margin: 0;
    }

    .content {
        color: #555555;
        line-height: 1.6;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        color: #777777;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Your Password Has Been Changed By Administrator</h1>
    </div>
    <div class="content">
        <p>Dear {{ $details['role'] }},</p>
        <p>As part of our security protocol, your new password has been generated for your access to <strong>Eastern Visayas State University Reservation Management System</strong>. Please find the new password below:</p>
        <p><strong>New Password:</strong> {{ $details['password'] }}</p>
        <p>Please use this new password to log in to our system. For security purposes, we recommend changing your password after logging in.</p>
        <p>Thank you for your attention to this matter.</p>
    </div>
    <div class="footer">
        <p>
            Best regards,<br>
            EVSURMS<br>
        </p>
    </div>
</div>