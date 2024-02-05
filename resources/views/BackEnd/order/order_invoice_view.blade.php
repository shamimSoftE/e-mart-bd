<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Order Invoice</title>
    <style>
        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #5D6975;
        text-decoration: underline;
        }

        body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
        }

        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }

        #logo {
        text-align: center;
        margin-bottom: 10px;
        }

        #logo img {
        width: 90px;
        }

        h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
        }

        #project {
        float: left;
        }

        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }

        #company {
        float: right;
        text-align: right;
        }

        #project div,
        #company div {
        white-space: nowrap;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }

        table th,
        table td {
        text-align: center;
        }

        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
        }

        table .service,
        table .desc {
        text-align: left;
        }

        table td {
        padding: 20px;
        text-align: right;
        }

        table td.service,
        table td.desc {
        vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table td.grand {
        border-top: 1px solid #5D6975;;
        }

        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }

        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }

        .tot{
            color: black!important;
            font-weight: 700;

        }
        .project{
          position: relative!important;
      }

    </style>

</head>

  {{-- @php
    $site= App\Models\SiteInfo::where('status',1)->first();
  @endphp --}}



<body>
    <header class="clearfix">

        <div id="logo">
            {{-- <img src="{{ asset("Back/images/app-logo.png")}}" > --}}
            <span style="width: 150px;text-transform: uppercase;
            font-size: 1.5rem; z-index: 1;filter:brightness(0.5)!important;">Real Shop BD</span>
        </div>



      <h1>INVOICE # {{ $order->id }}</h1>


      <div id="project" style="font-size: 15px">

        {{-- <div><span>PROJECT</span> Website development</div> --}}
        <div>Date: {{ $order->created_at->format('d-m-Y') }} </div><br/>



        <div>Customer Details</div>
        <div>
            <span>Customer</span>
            @if(!empty($order->shipping->name))
            {{ $order->shipping->name }}
            @else
                {{ __('N/A') }}
            @endif
        </div>

        <div>
            <span>Address</span>
            @if(!empty($order->shipping->address))
                {{ $order->shipping->address }}
            @else
                {{ __('N/A') }}
            @endif
        </div>
        <div>
            <span>Contact Number</span>
            @if(!empty($order->shipping->mobile))
                {{ $order->shipping->mobile }}
            @else
                {{ __('N/A') }}
            @endif
        </div>
        <div>
            <span>EMAIL</span>
            @if (!empty($order->shipping->email ))

            <a href="mailto:{{ $order->shipping->email  }}">{{ $order->shipping->email  }}</a>
            @else
                N/A
            @endif

        </div>
        {{-- <div>
            <span>MOBILE</span>
            @if (!empty($order->shipping->mobile ))
            {{ $order->shipping->mobile  }}
            @else
                N/A
            @endif
        </div> --}}
        {{-- <div><span>DUE DATE</span> September 17, 2015</div> --}}
      </div>

    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">SL</th>
            <th class="desc">Item Name</th>
            <th>PRICE</th>
            <th>QTY</th>
            {{--<th>Color</th>--}}
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>

            @foreach (json_decode($order['products'], true) as $key => $data )

                <tr>
                    <td class="service">{{ ++$key }}</td>
                    <td class="desc">
                        {{ $data["name"] }}
                    </td>
                    <td class="unit">tk.{{ number_format($data["price"]) }}</td>
                    <td class="qty">{{ $data['quantity'] }}</td>

                    <td class="total">tk.{{ number_format($data["price"] * $data['quantity']) }}</td>
                </tr>
            @endforeach

          <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total ">tk.{{ number_format($order->sub_total) }} </td>
          </tr>
            <tr>
                <td colspan="4">SHIPPING CHARGE</td>
                  <td class="total ">tk.{{number_format($order->shipping_charge)}}</td>
            </tr>
            <tr>
                <td colspan="4" class="grand total">GRAND TOTAL</td>
                <td class="grand total tot">tk.{{number_format($order->grand_total)}} </td>
            </tr>


        </tbody>
      </table>









        <div class="f" style="float:left">

            ------------------------------<br>
            <span style="margin-left: 30px">Received By</span>


        </div>


        <div class="f" style="margin-left: 230px;float:left">

            ------------------------------<br>
            <span style="margin-left: 25px">Delivery Man</span>

        </div>


        <div class="f" style="margin-left: 205px;float:left">

            -----------------------------<br>
            <span style="margin-left: 25px">Official Sign</span>

        </div>

      {{--<div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>--}}
    </main>
    {{-- <footer>

        <b>Protivashop.com</b> Thank you for your order <b>{{$order->tracking_number}}</b>. Our call center agent will get in
        touch with you shortly. For help: 01612008280
    </footer> --}}


  </body>
</html>
