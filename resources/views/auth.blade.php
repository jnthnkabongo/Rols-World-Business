<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol's World Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #EEEEF2 0%, #BBB9BC 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .input-icon {
            transition: all 0.3s ease;
        }
        .input-field:focus + .input-icon {
            color: #DCDEE8;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="glass-card p-8 rounded-2xl shadow-2xl w-full max-w-md transform hover:scale-[1.02] transition-transform duration-300">
        <!-- Logo/Icon -->
        <div class="text-center mb-4">
            <div class="inline-flex items-center justify-center w-60 h-60 mb-1">
                <img src="{{ asset('images/logo-1.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-1">Bienvenue</h1>
            <p class="text-gray-500 text-sm">Connectez-vous pour continuer</p>
        </div>
        
        <form method="POST" action="/login" class="space-y-6">
            @csrf
            
            <div class="relative">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <div class="relative">
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        class="input-field w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                        placeholder="votre@email.com"
                    >
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 input-icon"></i>
                </div>
            </div>
            
            <div class="relative">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Mot de passe</label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="input-field w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white"
                        placeholder="••••••••"
                    >
                    <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 input-icon"></i>
                </div>
            </div>
            
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                </label>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">Mot de passe oublié ?</a>
            </div>
            
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <i class="fas fa-sign-in-alt mr-2"></i>
                Se connecter
            </button>
        </form>
        
        @if (session('error'))
            <div class="mt-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                {{ session('error') }}
            </div>
        @endif
        
        {{-- <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                Pas encore de compte ? 
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">Contactez l'administrateur</a>
            </p>
        </div> --}}
    </div>
</body>
</html>
