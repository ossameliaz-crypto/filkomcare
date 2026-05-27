<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Login - FilkomCare</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { 
            font-family: 'Poppins', sans-serif; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        html, body { 
            overscroll-behavior: none;
            -webkit-tap-highlight-color: transparent;
        }
        /* Hide password reveal for Edge/IE */
        input::-ms-reveal { display: none; }
    </style>
</head>
<body class="bg-white min-h-screen flex justify-center">

    {{-- Mobile App Container --}}
    <div class="w-full max-w-[430px] min-h-screen bg-white flex flex-col relative">
        
        {{-- Content Area --}}
        <div class="flex-1 flex flex-col px-7 pt-16">

            {{-- Logo --}}
            <div class="flex justify-center mb-8">
                <img src="/images/logo-filkomcare.png" alt="FilkomCare" class="h-[85px] w-auto object-contain">
            </div>

            {{-- Title Section - Left aligned --}}
            <div class="mb-6">
                <h1 class="text-[26px] font-bold text-slate-dark leading-tight">Login</h1>
                <p class="text-[13px] text-gray-400 mt-1 font-light">Login ke akun FilkomCare</p>
            </div>

            {{-- Form --}}
            <form action="{{ url('/login') }}" method="POST" class="w-full">
                @csrf

                {{-- Error Messages --}}
                @if (session('success'))
                    <div class="bg-green-50 border border-success/20 text-success p-3 rounded-xl text-[11px] mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('login_error'))
                    <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[11px] mb-4">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                @if ($errors->any() && !$errors->has('login_error'))
                    <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[11px] mb-4">
                        <ul class="list-disc pl-4 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- NIM / Email Input --}}
                <div class="mb-1">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100">
                        <input type="text" name="nim" value="{{ old('nim') }}" required
                            placeholder="Input your NIM number or email" 
                            class="w-full bg-transparent text-slate-dark placeholder-gray-400 text-[13px] focus:outline-none font-normal">
                    </div>
                    <p class="text-[10px] text-gray-300 mt-1.5 ml-1 font-light">Gunakan email UB aktif (@student.ub.ac.id)</p>
                </div>

                {{-- Password Input --}}
                <div class="mb-6 mt-3">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 flex items-center">
                        <input type="password" name="password" id="passwordInput" required
                            placeholder="Input your password" 
                            class="w-full bg-transparent text-slate-dark placeholder-gray-400 text-[13px] focus:outline-none font-normal flex-1">
                        <button type="button" onclick="togglePassword()" class="ml-2 text-gray-400 hover:text-slate-dark transition focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Login Button --}}
                <button type="submit" 
                    class="w-full bg-primary hover:bg-primary-hover active:bg-primary-dark text-white font-semibold text-[14px] py-4 rounded-2xl shadow-sm transition-all duration-200 transform active:scale-[0.98]">
                    Login Now
                </button>

                {{-- Forgot Password --}}
                <div class="text-center mt-5">
                    <a href="#" class="text-[13px] text-slate-dark font-semibold hover:text-primary transition">
                        Forgot password?
                    </a>
                </div>
            </form>

        </div>

        {{-- Bottom Link --}}
        <div class="w-full text-center pb-10 pt-6">
            <p class="text-[12px] text-gray-400 font-normal">
                Kamu belum punya akun? 
                <a href="{{ url('/register') }}" class="text-slate-dark font-bold hover:text-primary transition">Sign up now</a>
            </p>
        </div>

    </div>

    {{-- Toggle Password Script --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
