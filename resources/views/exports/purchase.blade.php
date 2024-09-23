<!-- resources/views/users/pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Data Absensi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .photo img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>

<body>
    <h1>Data Absensi</h1>
    <table>
        <thead>
            <tr>
                <th class="text-truncate">Kode</th>
                <th class="text-truncate">Nama Material</th>
                <th class="text-truncate">Jumlah</th>
                <th class="text-truncate">Harga</th>
                <th class="text-truncate">Total Harga</th>
                <th class="text-truncate">Nama Supplier</th>
                <th class="text-truncate">Status</th>
                <th class="text-truncate">Tgl Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $index => $p)
                <tr>
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->material->name }}</td>
                    <td>{{ $p->quantity }}</td>
                    <td>{{ $p->price }}</td>
                    <td>{{ $p->total }}</td>
                    <td>{{ $p->supplier->name }}</td>
                    <td>{{ $p->status->name }}</td>
                    <td>{{ $p->created_at->format('F j, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
