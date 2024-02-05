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
        <th>Dear Seller @if(!empty($name)) [ {{ $name }} ] @else @endif.</th>
    </tr>
    <tr>
        <th>You have a new order. Click <a href="{{ route('seller_center') }}">here</a> to manage your order. </th>
    </tr>
    <hr/>

    </thead>

</table>


<table class="table" style="width:100%">
    <thead>
    <tr>
        <th>Here is your order Details Information</th>
    </tr>
    <hr/>
    <tr>
        <th>Product Name</th>
        <th>Product Price</th>
        {{-- <th>product Image</th> --}}
        <th>Quantity</th>
        <th>Color</th>
    </tr>
    </thead>
    <tbody>

    @php
        $total = 0;
        $price = 0;
    @endphp

    @foreach ($orderMasters as $orderMas )

        <?php
            $total += $orderMas->product_qty * $orderMas->product_price;
        ?>

        <tr>

            <th>
                @if(!empty($orderMas->product->name))
                {{ $orderMas->product->name }}
                @else
                    N/A
                @endif
            </th>

            <th>TK.{{ $orderMas->product_price }}</th>

            <th>{{ $orderMas->product_qty }}</th>
            <th>{{ $orderMas->product_color }}</th>

{{--            <input type="hidden" value="{{ $total = $orderMas->product_qty * $orderMas->product_price }}">--}}

        </tr>
    @endforeach

    <tr><th>&nbsp; </th></tr>
    {{-- <hr/> --}}
    <tr><th style="float: right">Grand Total: TK.{{ $total }} </th></tr>

    <tr><th>&nbsp; </th></tr>
    {{--<tr>
        <td>
            Note: ডেলিভারি ম্যানকে আগে টাকা বুঝিয়ে দিয়ে প্রোডাক্টটি বুঝে নিবেন।
            ডেলিভারি ম্যান থাকাকালীন প্রোডাক্ট চেক করুন।
            ডেলিভারি ম্যান চলে আসার পর কোনো অভিযোগ গ্রহণ করা হবে না।
        </td>
    </tr>
    <tr><td>&nbsp; </td></tr>--}}
    <tr>
        <td>Thanks & Regards,</td>
    </tr>
    <tr>
        <td>Protivashop-Team </td>
    </tr>
    </tbody>
</table>


</body>
</html>

