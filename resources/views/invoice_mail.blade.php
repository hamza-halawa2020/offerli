<!-- resources/views/emails/invoice_generated.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Hello,</p>
    <p>Your invoice has been generated with number {{$invoice->invoice_number}}. </p>
    <a href="{{route('branch.invoice.show' , $invoice)}}">Tap To See it</a>
    <p>Thank you!</p>
</body>

</html>
