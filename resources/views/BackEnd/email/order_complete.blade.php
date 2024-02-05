<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th>Dear {{ $name }}</th>
        </tr>
        <tr><th>&nbsp; </th></tr>
        <tr>
            <td>
                <strong>Order Tracking Number:</strong>
                <h1> {{ $track }} </h1>
                <hr>
                {{--<a href="{{"https://www.tarzanbd.com/tracking-item?query=".$track  }}" style="text-align: center; font-size: 14px;color: #8500ff">
                    Track Order
                </a>--}}
            </td>
        </tr>

        <tr>
            <th>You have an Order. Here is your shipping Information. </th>
        </tr>
        <hr/>

        </thead>
        <tbody>
            <tr><td>Name: {{ $shippingName }} </td></tr>
            <tr><td>Mobile: {{ $mobile }} </td></tr>

            <tr><td>Address: {{ $village }} </td></tr>
            <tr><td>City: {{ $city }} </td></tr>
            <tr><td>Delivery Charge: Tk.{{ $charge }} </td></tr>
            {{-- <tr><td>State: {{ $state }} </td></tr> --}}
            <tr><td>&nbsp; </td></tr>
        </tbody>

    </table>


    <table class="table" style="width:100%">
        <thead>
            <tr> <th><strong>Order Details Information</strong></th> </tr>
            <hr/>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                {{-- <th>product Image</th> --}}
                <th>Quantity</th>
                <th>Color</th>
                <th>Size</th>
            </tr>
        </thead>
        <tbody>
        @php
            $gtotal = 0;
        @endphp

            @foreach ($orderMasters as $orderMas )
                <?php
                $gtotal += $orderMas->product_qty * $orderMas->product_price;
                ?>
                <tr>

                    <th>{{ $orderMas->product->name }}</th>

                    <th>TK.{{ $orderMas->product_price }}</th>

                    <th>{{ $orderMas->product_qty }}</th>

                    <th>
                        @if (!empty($orderMas->product_color ))
                            {{ $orderMas->product_color  }}
                            @else
                            N/A
                        @endif
                    </th>

                    <th>
                        @if (!empty($orderMas->product_size ))
                            {{ $orderMas->product_size  }}
                            @else
                            N/A
                        @endif
                    </th>
                </tr>
            @endforeach

            <tr><th>&nbsp; </th></tr>
            {{-- <hr/> --}}
            <tr><th style="float: right">Grand Total: TK.{{ $gtotal }} </th></tr>

            <tr><th>&nbsp; </th></tr>
            <tr>
                <td>
                    Note: ডেলিভারি ম্যানকে আগে টাকা বুঝিয়ে দিয়ে প্রোডাক্টটি বুঝে নিবেন।
                    ডেলিভারি ম্যান থাকাকালীন প্রোডাক্ট চেক করুন।
                    ডেলিভারি ম্যান চলে আসার পর কোনো অভিযোগ গ্রহণ করা হবে না।
                </td>
            </tr>
            <tr><td>&nbsp; </td></tr>
            <tr>
                <td>Thanks & Regards,</td>
            </tr>
            <tr>
                <td>Protiva-Shop Team </td>
            </tr>
        </tbody>
    </table>


</body>
</html>

