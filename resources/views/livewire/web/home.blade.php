@section('title', 'STIT Assunniyyah Tambarangan')

@section('description')
    Situs Resmi STIT Assunniyyah Tambarangan. Berisi Informasi atau berita terbaru tentang STIT
    Assunniyyah Tambarangan
@endsection
<div>
    <section class="bg-[url('kampus.jpg')] h-[450px] bg-center bg-no-repeat bg-cover bg-fixed relative">
        <div class="bg-green-600 h-[450px] w-full opacity-70 absolute">
        </div>
        <div class="absolute w-full">
            <div class="mt-10 flex flex-col p-5 items-center">
                <img width="150px" src="{{ asset('assets/main-logo.png') }}" class="ml-auto mr-auto">
                <div class="lg:w-[70%] ml-auto mr-auto mt-4 text-center">
                    <h1 class="text-3xl lg:text-5xl font-bold text-white">SELAMAT DATANG
                    </h1>
                    <h1 class="text-3xl lg:text-5xl font-bold text-white">DI STIT ASSUNNIYYAH TAMBARANGAN
                    </h1>
                </div>
                <div class="flex justify-center flex-col lg:block">
                    <a href="#berita"
                        class="btn text-white w-60 mt-4 m-2 bg-amber-400 border-0 hover:bg-amber-700 shadow-xl">Lebih
                        Banyak</a>
                </div>
            </div>
        </div>
    </section>
    <section id="berita" class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-10">
            <h3 class="text-center font-semibold text-green-500 text-2xl">Berita Pilihan</h3>
            <p class="text-center text-sm mt-2 leading-loose">
                Tetap terhubung dengan berita dan informasi terbaru tentang berbagai aktivitas di Kampus STIT
                Assunniyyah Tambarangan
            </p>
            <hr class="w-[50px] mx-auto mt-2 border-amber-400 border-[1px]">
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-10 grid lg:grid-cols-3 grid-cols-1 gap-5">
            @foreach ($posts as $post)
                <a wire:navigate href="/read/{{ $post->slug }}">
                    <div class="relative">
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="thumbnail">
                        @endif
                        <div
                            class="absolute bottom-[-15px] bg-amber-400 p-2 rounded translate-x-[50%] right-[50%] text-xs font-bold text-white">
                            <p class="text-center">
                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-[25px] text-center">
                        <h2 class="text-xl font-bold text-green-600">
                            {{ $post->title }}
                        </h2>
                        <p class="text-sm text-slate-500 mt-2">
                            {{ $post->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="flex items-center justify-center mt-5">
            <a wire:navigate href="/category/berita"
                class="btn mx-auto bg-transparent border-green-600 border-[2px] text-green-700 flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                Baca Berita Lainnya
            </a>
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-16">
            <h3 class="text-center font-semibold text-green-500 text-2xl">Pengumuman</h3>
            <hr class="w-[50px] mx-auto mt-2 border-amber-400 border-[1px]">
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-5 grid lg:grid-cols-3 grid-cols-1 gap-5">
            @foreach ($pengumuman as $p)
                <a wire:navigate href="/read/{{ $p->slug }}">
                    <div class="">
                        <h2 class="text-xl font-bold text-green-600">
                            {{ $p->title }}
                        </h2>
                        <p class="text-slate-400">
                            {{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('j F Y') }}
                        </p>
                        <p class="text-sm text-slate-500 mt-2">
                            {{ $p->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="flex items-center justify-center mt-5">
            <a wire:navigate href="/category/pengumuman"
                class="btn mx-auto bg-transparent border-green-600 border-[2px] text-green-700 flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
                Pengumuman Lainnya
            </a>
        </div>
    </section>
    <x-footer />

</div>
