<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{

font-family: DejaVu Sans;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

table td{

padding:6px;

border:1px solid #ddd;

}

h2{

text-align:center;

}

</style>

</head>

<body>

<h2>

BUKTI BOOKING

</h2>

<hr>

<table>

<tr>

<td width="35%">Kode Booking</td>

<td>{{ $booking->kode_booking }}</td>

</tr>

<tr>

<td>Nama Pemesan</td>

<td>{{ $booking->nama_pemesan }}</td>

</tr>

<tr>

<td>Nama Pengantin</td>

<td>{{ $booking->nama_pengantin }}</td>

</tr>

<tr>

<td>Paket</td>

<td>{{ $booking->paket->nama_paket }}</td>

</tr>

<tr>

<td>Tanggal Acara</td>

<td>{{ $booking->tanggal_acara }}</td>

</tr>

<tr>

<td>Lokasi</td>

<td>{{ $booking->lokasi_acara }}</td>

</tr>

<tr>

<td>Total Paket</td>

<td>

Rp {{ number_format($booking->total_paket,0,',','.') }}

</td>

</tr>

<tr>

<td>Total Addon</td>

<td>

Rp {{ number_format($booking->total_addon,0,',','.') }}

</td>

</tr>

<tr>

<td>Total Pesanan</td>

<td>

Rp {{ number_format($booking->total_harga,0,',','.') }}

</td>

</tr>

<tr>

<td>DP</td>

<td>

Rp {{ number_format($booking->nominal_dp,0,',','.') }}

</td>

</tr>

<tr>

<td>Status</td>

<td>

{{ $booking->status }}

</td>

</tr>

</table>

<br>

<h4>

Barang Tambahan

</h4>

<table>

<tr>

<th>Barang</th>

<th>Jumlah</th>

<th>Subtotal</th>

</tr>

@foreach($booking->addons as $addon)

<tr>

<td>

{{ $addon->nama_barang }}

</td>

<td>

{{ $addon->pivot->jumlah }}

</td>

<td>

Rp {{ number_format($addon->pivot->subtotal,0,',','.') }}

</td>

</tr>

@endforeach

</table>

<br><br>

<p>

Terima kasih telah melakukan pemesanan di

<strong>Omah Dekorasi Klaten</strong>

</p>

</body>

</html>
