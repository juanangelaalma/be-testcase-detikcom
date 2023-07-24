<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data Buku</title>
</head>
<body>
  <div style="font-family: Arial, sans-serif;">
    <div>
      <h1>Data Buku</h1>
        <table style="border-collapse: collapse; width: 100%; text-align: left;">
            <thead>
                <tr tabindex="0" style="background-color: #f2f2f2;">
                    <th style="padding: 10px; border: 1px solid #ccc;">
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">#</p>
                    </th>
                    <th style="padding: 10px; border: 1px solid #ccc;">
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">Judul Buku</p>
                    </th>
                    <th style="padding: 10px; border: 1px solid #ccc;">
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">Kategori</p>
                    </th>
                    <th style="padding: 10px; border: 1px solid #ccc;">
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">Deskripsi</p>
                    </th>
                    <th style="padding: 10px; border: 1px solid #ccc;">
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">Jumlah</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($books as $book)
                    <tr tabindex="0" style="background-color: #fff;">
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <p style="margin: 0;">{{ $no }}</p>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <p style="margin: 0;">
                                {{ $book->title }}
                            </p>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <p style="margin: 0; text-transform: capitalize">
                                {{ $book->category->name }}
                            </p>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <p style="margin: 0;">
                                {{ $book->description }}
                            </p>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ccc;">
                            <p style="margin: 0;">
                                {{ $book->quantity }}
                            </p>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
