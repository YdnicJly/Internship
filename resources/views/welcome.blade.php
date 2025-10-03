<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lowongan Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6 text-blue-600">Daftar Lowongan Magang</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($lowongan as $item)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $item['judul'] }}</h2>
                    <p class="text-gray-600">{{ $item['perusahaan'] }} - {{ $item['lokasi'] }}</p>
                    <p class="mt-2 text-sm text-gray-500">{{ $item['deskripsi'] }}</p>
                    <p class="mt-4 text-sm text-red-500">Deadline: {{ $item['deadline'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
