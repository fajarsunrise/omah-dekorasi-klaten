<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>Laporan Rekap Pemesanan</title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin: 0 0 5px 0;
        }

        h4 {
            text-align: center;
            margin: 0;
        }

        .info {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #e9e9e9;
            padding: 6px;
            text-align: center;
        }

        td {
            padding: 5px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            width: 45%;
            margin-left: auto;
            margin-top: 20px;
        }

        .summary th {
            text-align: left;
        }

        .footer {
            margin-top: 25px;
            font-weight: bold;
        }

    </style>

</head>

<body>

    <h2>LAPORAN REKAP PEMESANAN</h2>

    <h4>Omah Dekorasi Klaten</h4>

    <div class="info">

        <strong>Periode :</strong>
        {{ $periode ?: 'Semua Data' }}

        <br>

        <strong>Tanggal Cetak :</strong>
        {{ $tanggalCetak }}

    </div>


    @php

        $totalDP = 0;
        $totalPelunasan = 0;

    @endphp


    <table>

        <thead>

            <tr>

                <th width="5%">No</th>

                <th width="12%">Kode Booking</th>

                <th width="15%">Pemesan</th>

                <th width="15%">Paket</th>

                <th width="12%">Tanggal Acara</th>

                <th width="12%">Total</th>

                <th width="10%">DP</th>

                <th width="12%">Pelunasan</th>

                <th width="7%">Status</th>

            </tr>

        </thead>


        <tbody>

        @forelse($rekaps as $rekap)

            @php

                $totalDP += $rekap->nominal_dp ?? 0;

                $totalPelunasan += $rekap->nominal_pelunasan ?? 0;

            @endphp


            <tr>

                <td class="text-center">

                    {{ $loop->iteration }}

                </td>


                <td class="text-center">

                    {{ $rekap->booking?->kode_booking ?? '-' }}

                </td>


                <td>

                    {{ $rekap->nama_pemesan }}

                </td>


                <td>

                    {{ $rekap->paket }}

                </td>


                <td class="text-center">

                    {{ $rekap->tanggal_acara
                        ? $rekap->tanggal_acara->format('d-m-Y')
                        : '-' }}

                </td>


                <td class="text-right">

                    Rp {{ number_format(
                        $rekap->total_harga ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="text-right">

                    Rp {{ number_format(
                        $rekap->nominal_dp ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="text-right">

                    Rp {{ number_format(
                        $rekap->nominal_pelunasan ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>


                <td class="text-center">

                    {{ $rekap->status }}

                </td>

            </tr>


        @empty

            <tr>

                <td colspan="9" class="text-center">

                    Belum ada data pemesanan selesai.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>


    <table class="summary">

        <tr>

            <th width="60%">
                Jumlah Booking
            </th>

            <td class="text-right">

                {{ $rekaps->count() }}

            </td>

        </tr>


        <tr>

            <th>
                Total DP
            </th>

            <td class="text-right">

                Rp {{ number_format(
                    $totalDP,
                    0,
                    ',',
                    '.'
                ) }}

            </td>

        </tr>


        <tr>

            <th>
                Total Pelunasan
            </th>

            <td class="text-right">

                Rp {{ number_format(
                    $totalPelunasan,
                    0,
                    ',',
                    '.'
                ) }}

            </td>

        </tr>


        <tr>

            <th>
                Total Pendapatan
            </th>

            <td class="text-right">

                <strong>

                    Rp {{ number_format(
                        $totalDP + $totalPelunasan,
                        0,
                        ',',
                        '.'
                    ) }}

                </strong>

            </td>

        </tr>

    </table>


    <div class="footer">

        <p>
            Laporan ini merupakan rekap pemesanan yang telah berstatus Selesai.
        </p>

    </div>

</body>
</html>
