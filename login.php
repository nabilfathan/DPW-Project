<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --gold: #b39359;
            --dark-overlay: rgba(10, 10, 10, 0.85);
        }
        body {
            font-family: 'Montserrat', sans-serif;
            /* Background menggunakan foto prewedding atau wedding yang gelap/moody */
            background: linear-gradient(var(--dark-overlay), var(--dark-overlay)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            color: white;
        }
        .font-serif { font-family: 'Playfair Display', serif; }

        .glass-login {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(179, 147, 89, 0.2); /* Border emas tipis */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .input-luxury {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: 0.4s;
            letter-spacing: 0.05em;
        }

        .input-luxury:focus {
            border-color: var(--gold);
            background: rgba(255, 255, 255, 0.07);
            outline: none;
        }

        .btn-gold {
            border: 1px solid var(--gold);
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 11px;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-gold:hover {
            background: var(--gold);
            color: black;
            box-shadow: 0 0 20px rgba(179, 147, 89, 0.3);
        }

        .divider {
            width: 40px;
            height: 1px;
            background: var(--gold);
            margin: 1.5rem auto;
            opacity: 0.6;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen p-6">
    <div class="w-35 max-w-400px">
        
        <header class="text-center mb-10">
            <p class="text-[10px] tracking-[0.4em] uppercase text-zinc-400 mb-2">Private Access</p>
            <h1 class="text-3xl font-serif italic tracking-widest text-white">Administrator Access</h1>
            <div class="divider"></div>
        </header>
        
        <div class="glass-login p-10 md:p-12">
            <h2 class="text-xs tracking-[0.3em] uppercase text-center mb-10 text-zinc-300">Administrator Login</h2>
            
    <form id="loginForm" class="space-y-6">
        <input type="text" id="username" required class="input-luxury w-25 px-4 py-4 text-xs" placeholder="USERNAME">
        <input type="password" id="password" required class="input-luxury w-25 px-4 py-4 text-xs" placeholder="PASSWORD">
    
    <div class="pt-4">
        <button type="submit" class="btn-gold w-full py-4 font-medium">Enter Dashboard</button>
        </div>
        <p id="errorMsg" class="text-red-500 text-[10px] text-center mt-2 hidden">Kredensial Salah!</p>
    </form>

   <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const user = document.getElementById('username').value;
        const pass = document.getElementById('password').value;

        if (user === "admin" && pass === "admin123") {
            sessionStorage.setItem('isLoggedIn', 'true'); 
            window.location.replace("dashboard.php"); 
        } else {
            const errorMsg = document.getElementById('errorMsg');
            if (errorMsg) {
                errorMsg.classList.remove('hidden');
            } else {
                alert("Username atau Password Salah!");
            }
        }
    });
    </script>
            
            <div class="mt-8 text-center">
                <a href="#" class="text-[9px] uppercase tracking-widest text-zinc-500 hover:text-white transition">
                    Forgot Credential?
                </a>
            </div>
        </div>

        <footer class="mt-12 text-center">
            <p class="text-[9px] tracking-widest text-zinc-600 uppercase">
                &copy; 2026 Exclusive Wedding Organizer
            </p>
        </footer>
    </div>
</body>
</html>
