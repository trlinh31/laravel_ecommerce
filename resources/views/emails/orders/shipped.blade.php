<!DOCTYPE html>
<html>

<head>
  <title>Mail</title>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 15px;
    }
  </style>
</head>

<body>
  <h3>Order details:</h3>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      @php
        $total = 0;
      @endphp
      @foreach ($order->order_details as $item)
        @php
          $total += $item->price;
        @endphp
        <tr>
          <td>{{ $item->product->name }}</td>
          <td>{{ $item->size }}</td>
          <td>{{ $item->color }}</td>
          <td>{{ $item->quantity }}</td>
          <td>${{ $item->price }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <strong style="padding-top: 8px;">Total: ${{ $total }}</strong>
</body>

</html>
