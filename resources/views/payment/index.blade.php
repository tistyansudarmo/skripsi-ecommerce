<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color:  
#f5f5f5;  

    }

    button {
        background-color: #3498db;
        color: #fff;
        padding: 15px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
    }
</style>
</head>
<body>
    <button id="pay-button">Pay Now</button>

    <script type="text/javascript">
        // Replace with the ID of your pay button
        var payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
              /* Redirect to order page on successful payment */
              window.location.href = '/order'; // Replace '/orders/' with your actual order URL prefix
              alert("Payment Success!");
            },
            onPending: function(result) {
              /* You may add your own implementation here */
              alert("Waiting for your payment!");
            },
            onError: function(result) {
              /* You may add your own implementation here */
              alert("Payment failed!");
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('You closed the popup without finishing the payment');
            }
          });
        });
      </script>
</body>
</html>
