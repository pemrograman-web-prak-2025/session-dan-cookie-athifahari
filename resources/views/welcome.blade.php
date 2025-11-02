<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlantCare Scheduler - Kelola Tanaman Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-nature {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-nature min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4">
        <div class="text-center mb-8">
            <i class="fas fa-leaf text-6xl text-green-500 mb-4"></i>
            <h1 class="text-3xl font-bold text-gray-800">PlantCare Scheduler</h1>
            <p class="text-gray-600 mt-2">Kelola jadwal perawatan tanaman dengan mudah</p>
        </div>
        
        <div class="space-y-4">
            <a href="{{ route('login') }}" 
               class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
            </a>
            
            <a href="{{ route('register') }}" 
               class="w-full border border-green-500 text-green-500 hover:bg-green-50 font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                <i class="fas fa-user-plus mr-2"></i>Daftar
            </a>
        </div>
        
        <div class="mt-8 text-center text-gray-500">
            <p><i class="fas fa-seedling mr-2"></i>Siram, pupuk, dan rawat tanaman tepat waktu</p>
        </div>
    </div>
</body>
</html>