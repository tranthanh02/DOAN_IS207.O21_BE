<!-- resources/views/emails/order-confirmation.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>

<body>
    <p>Hi {{ $userName }},</p>

    <p>Thank you for your order. Here are the details of your purchase:</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Link</th> <!-- Thêm cột Link -->
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product['productId'] }}</td>
                <td>{{ $product['quantityPurchased'] }}</td>
                <td><a href="http://localhost:3000/detail/?productId={{ $product['productId'] }}">View Product</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p>If you have any questions or concerns, please feel free to contact us.</p>

    <p>Thank you for shopping with us!</p>
</body>

</html>