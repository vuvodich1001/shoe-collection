<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mail</title>
    <style>
        .template-title,
        .footer {
            background: #F7FBFC;
        }

        table {
            vertical-align: center;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="d-flex  flex-column align-items-center justity-content-center template-title p-3">
            <img src="https://cdn.templates.unlayer.com/assets/1649230975765-iccccon.png" alt="image"
                style="width: 100x; height: 90px;">
            <h4>Thank for your purchase!</h4>
            <p class="my-1">Hi, Vunguyen. Đơn hàng của bạn đang được xử lí</p>
            <p class="my-1">Chúng tôi sẽ thông báo cho bạn khi đơn hàng được gửi đi</p>
            <a href="http://localhost:5000/account/order">
                <button class="btn btn-dark">View more order</button>
            </a>
        </div>
        <hr>
        <div class="template-payment d-flex justify-content-around">
            <div>
                <h5>Shipping address</h5>
                <span>Long Truong, Thu Duc, HCMC</span>
            </div>
            <div>
                <h5>Payment method</h5>
                <span>COD</span>
            </div>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="3" class="text-center">
                        <h4>
                            Order Summary
                        </h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)

                @endforeach
                <tr>
                    <td>
                        <img src="{{ $detail['shoe']['defaultImage']['image'] }}" alt="image"
                            style="width: 90px; height: 80px;">
                    </td>
                    <td>
                        <span><strong>{{$detail['shoe']['name']}}</strong> x {{$detail['quantity']}}</span>
                    </td>
                    <td>
                        <span>{{ number_format($detail['quantity'] * $detail['shoe']['price'], 0, '.', '.') }}đ</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right font-weight-bold">Subtotal</td>
                    <td>{{number_format($fees['subtotal'], 0, '.', '.')}}đ</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right font-weight-bold">Shipping</td>
                    <td>{{number_format($fees['shippingFee'], 0, '.', '.')}}đ</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right font-weight-bold">Total</td>
                    <td>{{number_format($fees['total'], 0, '.', '.')}}đ</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <p class="text-center">
                    If you have any questions, reply to this<br>
                    email or contact us at <strong>laravel@gmail.com</strong><br>
                    Long Truong, ThuDuc, HCMC
                </p>
                <div class="social-link text-center">
                    <i class="mx-2 fa-brands fa-facebook" style="font-size: 25px;"></i>
                    <i class="mx-2 fa-brands fa-instagram" style="font-size: 25px;"></i>
                    <i class="mx-2 fa-brands fa-youtube" style="font-size: 25px;"></i>
                    <i class="mx-2 fa-brands fa-github" style="font-size: 25px;"></i>
                </div>
            </div>
        </div>
    </main>
</body>

</html>