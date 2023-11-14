<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: beige;
            display: grid;
            justify-items: center;
        }

        .headline {
            color: #252b48;
            font-size: 1.6rem;
            font-weight: bold;
            margin: 0
        }

        .instruction {
            color: #267871;
            font-size: 1.2em;
        }

        .verify-button {
            padding: 10px;
            font-size: 1.2rem;
            color: #ffff;
            background-color: #ff6000;
            border-radius: 0.3em;
            outline: none;
            border: 0px;
        }
    </style>
</head>

<body>
    <P class="headline">Thank you for Signing to EventPulse</P>
    <p class="instruction">Click the following button to verify your email</p>
    <a href={{ $link }}> <button class="verify-button">Verify</button> </a>
</body>

</html>
