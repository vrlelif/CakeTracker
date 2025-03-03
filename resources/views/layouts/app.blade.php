<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto mt-8">
        <nav class="bg-white p-4 shadow-md rounded">
            <ul class="flex space-x-4">
                <li><a href="{{ url('/') }}" class="text-blue-600 hover:underline">Upload Birthdays</a>
                </li>
                <li><a href="{{ url('/cake-days') }}" class="text-blue-600 hover:underline">View Cake Days</a></li>
            </ul>
        </nav>

        <div class="p-6">
            @yield('content')
        </div>
    </div>

</body>

</html>