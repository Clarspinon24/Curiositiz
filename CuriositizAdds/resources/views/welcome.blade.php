<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatMew — Discutez, ronronnez, connectez.</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🐱</span>
                <span class="text-xl font-extrabold bg-clip-text text-transparent" style="background-image: linear-gradient(90deg, #6366f1, #ec4899); -webkit-background-clip: text;">ChatMew</span>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">Se connecter</a>
                    <a href="{{ route('register') }}"
                       class="text-sm font-bold text-white px-4 py-2 rounded-xl transition hover:opacity-90"
                       style="background: linear-gradient(90deg, #6366f1, #ec4899);">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="min-h-screen flex items-center pt-24 pb-16 relative overflow-hidden" style="background: linear-gradient(135deg, #6366f1 0%, #ec4899 50%, #f59e0b 100%);">

        {{-- Cercles décoratifs --}}
        <div class="absolute top-20 left-10 w-64 h-64 rounded-full opacity-20 bg-white blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 rounded-full opacity-20 bg-white blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-6 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Texte --}}
                <div>
                    <span class="inline-flex items-center gap-2 bg-white/20 text-white text-sm font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur">
                        <span>✦</span> La messagerie qui ronronne
                    </span>

                    <h1 class="text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Discutez.<br>
                        Ronronnez.<br>
                        <span class="relative inline-block">
                            Connectez.
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 8 Q75 2 150 8 Q225 14 298 6" stroke="white" stroke-width="3" stroke-linecap="round" fill="none" opacity="0.6"/>
                            </svg>
                        </span>
                    </h1>

                    <p class="text-white/80 text-lg leading-relaxed mb-10 max-w-md">
                        ChatMew est la messagerie instantanée qui rend chaque conversation aussi douce qu'un ronron. Simple, rapide, et tellement mignon. 🐾
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center gap-2 bg-white font-bold text-indigo-600 px-8 py-3.5 rounded-xl hover:bg-gray-50 transition active:scale-95 shadow-lg text-base">
                            Commencer gratuitement →
                        </a>
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-2 bg-white/20 backdrop-blur text-white font-semibold px-8 py-3.5 rounded-xl border border-white/30 hover:bg-white/30 transition text-base">
                            Se connecter
                        </a>
                    </div>

                    {{-- Social proof --}}
                    <div class="flex items-center gap-4 mt-10">
                        <div class="flex -space-x-3">
                            @foreach(['🐱','🐾','😸','🙀'] as $emoji)
                            <div class="w-9 h-9 rounded-full bg-white/30 backdrop-blur border-2 border-white flex items-center justify-center text-sm">{{ $emoji }}</div>
                            @endforeach
                        </div>
                        <p class="text-white/80 text-sm">
                            <span class="font-bold text-white">+2 400 chats</span> déjà connectés
                        </p>
                    </div>
                </div>

                {{-- Illustration chat UI --}}
                <div class="hidden lg:flex justify-center">
                    <div class="bg-white/95 rounded-3xl shadow-2xl p-5 w-80 backdrop-blur">

                        {{-- Header --}}
                        <div class="flex items-center gap-3 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-xl" style="background: linear-gradient(135deg, #6366f1, #ec4899);">🐱</div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm">Minou</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                    <p class="text-xs text-gray-400">En ligne</p>
                                </div>
                            </div>
                            <div class="ml-auto flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                        </div>

                        {{-- Messages --}}
                        <div class="py-4 space-y-3">
                            <div class="flex justify-start">
                                <div class="bg-gray-100 text-gray-700 text-sm px-4 py-2 rounded-2xl rounded-tl-sm max-w-xs">
                                    Miaou ! 👋 Comment tu vas ?
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <div class="text-white text-sm px-4 py-2 rounded-2xl rounded-tr-sm max-w-xs" style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                                    Super bien, merci ! 😸
                                </div>
                            </div>
                            <div class="flex justify-start">
                                <div class="bg-gray-100 text-gray-700 text-sm px-4 py-2 rounded-2xl rounded-tl-sm max-w-xs">
                                    T'as vu le nouveau ChatMew ? 🐾
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <div class="text-white text-sm px-4 py-2 rounded-2xl rounded-tr-sm max-w-xs" style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                                    Oui, il est trop bien ! ✨
                                </div>
                            </div>
                            {{-- Typing indicator --}}
                            <div class="flex justify-start">
                                <div class="bg-gray-100 px-4 py-3 rounded-2xl rounded-tl-sm flex gap-1 items-center">
                                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></span>
                                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></span>
                                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Input --}}
                        <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                            <input type="text" placeholder="Écrivez un message... 🐱" class="flex-1 text-sm bg-gray-50 rounded-xl px-4 py-2 border border-gray-200 focus:outline-none focus:border-indigo-400" disabled>
                            <button class="w-9 h-9 rounded-xl flex items-center justify-center text-white shrink-0" style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</body>
</html>