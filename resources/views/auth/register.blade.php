<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-8 rounded shadow w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center mb-6">Daftar Akun</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-600 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/register" class="space-y-4">
        @csrf

        <div>
            <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full px-4 py-2 border rounded @error('name') border-red-500 @enderror"
                value="{{ old('name') }}" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 border rounded @error('email') border-red-500 @enderror"
                value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 border rounded @error('password') border-red-500 @enderror"
                required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full px-4 py-2 border rounded"
                required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
            Daftar
        </button>
    </form>

    <p class="text-center mt-4 text-sm text-gray-600">
        Sudah punya akun? <a href="/login" class="text-blue-500 hover:underline">Login di sini</a>
    </p>
</div>

</body>
</html>
