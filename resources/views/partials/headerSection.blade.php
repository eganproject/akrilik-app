<header class="relative pt-32 pb-20 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900 to-brand-900 opacity-90"></div>
            <div class="absolute top-0 right-0 w-2/3 h-full bg-brand-500/10 blur-[100px] rounded-full translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-1/2 h-full bg-purple-500/10 blur-[80px] rounded-full -translate-x-1/2"></div>
            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:40px_40px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="font-display text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
                {{ $title_1 ?? '' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-cyan-300">{{ $title_2 ??'' }}</span>
            </h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto font-light leading-relaxed animate-fade-in-up" style="animation-delay: 100ms;">
                {{ $description ??'' }}
            </p>
        </div>
    </header>