<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice Items</title>

		<style>

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: black;
        font-weight: bold;
        text-decoration: none;
        }

        body {
        position: relative;
        width: 21cm;
        height: 9cm;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
        }

        header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
        }

        #logo {
        float: left;
        margin-top: 8px;
        }

        #logo img {
        height: 70px;
        }

        #company {
        float: right;
        text-align: right;
        }


        #details {
        margin-bottom: 50px;
        }

        #client {
        padding-left: 6px;
        border-left: 6px solid black;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        }

        #invoice {
        float: right;
        text-align: right;
        }

        #invoice h1 {
        color: black;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }

        #invoice .date {
        font-size: 1.1em;
        color: #777777;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table th,
        table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        table th {
        white-space: nowrap;
        font-weight: normal;
        }

        table td {
        text-align: right;
        }

        table td h3{
        color: black;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: black;
        }

        table .desc {
        text-align: left;
        }

        table .unit {
        background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
        background: black;
        color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table tbody tr:last-child td {
        border: none;
        }

        table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
        border-top: none;
        }

        table tfoot tr:last-child td {
        color: black;
        font-size: 1.4em;
        border-top: 1px solid black;

        }

        table tfoot tr td:first-child {
        border: none;
        }
	</style>
	</head>
  <body onload="window.print()">
    <header class="clearfix">
      <div id="logo">
        <img src="../../../user/images/logo.png">
      </div>
      <div id="company">
        <h2 class="name">Anonim Project</h2>
        <div>Cigondewah Hilir , Margaasih , Bandung </div>
        <div>082319122678</div>
        <div><a href="mailto:anonim@project">anonim@project.com</a></div>
      </div>
      </div>
    </header>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</h2>
          <div class="address" style="width: 200px">{{ $order->customer_address1 }}</div>
          <div class="email">{{ $order->customer_phone }}</div>
          <div class="email"><a href="mailto:john@example.com">{{ $order->customer_email }}</a></div>
        </div>
        <div id="invoice">
          <h1>{{ $order->code }}</h1>
          <div class="date">Order Date : {{  date('d-m-Y', strtotime($order->order_date)); }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($order_items as $item)
            <tr>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ number_format($item->price*$item->qty) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">Orders Cost</td>
            <td>RP. {{ number_format($order->base_total_price) }}</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">Shippment Cost</td>
            <td>RP. {{ number_format($order->shipping_cost) }}</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>RP. {{ number_format($order->grand_total) }}</td>
          </tr>
        </tfoot>
      </table>
  </body>
</html>
