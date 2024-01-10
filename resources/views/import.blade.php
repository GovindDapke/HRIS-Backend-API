<!DOCTYPE html>
<html>

<head>


    <title>Laravel</title>

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Styles -->
</head>

<body class="antialiased">
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-8/12">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="py-4 px-6 bg-gray-100 border-b">
                        Import Excel
                    </div>

                    <div class="p-6">
                        @if (session('success'))
                        <div class="bg-green-100 text-green-600 border border-green-400 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="bg-red-100 text-red-600 border border-red-400 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="excel_file" class="block mb-2">Excel File</label>
                                <input type="file" id="excel_file" name="excel_file" class="py-2 px-4 border border-gray-300 rounded">
                                @error('excel_file')
                                <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import</button>
                            <a href="{{route('export-user')}}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded float-right">Export User</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>