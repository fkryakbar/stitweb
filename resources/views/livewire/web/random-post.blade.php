<div class="lg:border-l-slate-200 lg:border-l-[1px] lg:pl-3 basis-[30%]">
    <div class="lg:sticky lg:top-[20px]">
        <div class="mb-5">
            <h3 class="font-semibold text-green-500 text-2xl">Berita Lainnya</h3>
            <hr class="w-[50px] mt-2 border-amber-400 border-[1px]">
        </div>
        <div class="flex flex-col gap-4">
            @foreach ($posts as $post)
                <a wire:key='{{ $post->id }}' wire:navigate href="/read/{{ $post->slug }}">
                    <div class="">
                        <h2 class="text-xl font-bold text-green-600">
                            {{ $post->title }}
                        </h2>
                        <p class="text-slate-400 text-sm mt-2">
                            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
