@section('title', $post->title)

@section('description', $post->description)
@section('thumbnail', $post->image_path)
<div>
    <section class="bg-[url('kampus.jpg')] h-[220px] bg-center bg-no-repeat bg-cover bg-fixed relative">
        <div class="bg-green-600 h-[220px] w-full opacity-70 absolute">
        </div>
        <div class="absolute w-full">
            <div class="mt-10 flex flex-col p-5">
                <div class="lg:w-[60%] lg:mx-auto mt-4 border-l-[2px] pl-2 border-amber-400">
                    <h1 class="lg:text-5xl text-3xl font-bold text-white">{{ $post->category->name }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-2">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li><a href="/" wire:navigate>Beranda</a></li>
                    <li><a href="/category/{{ $post->category->key }}" wire:navigate>{{ $post->category->name }}</a>
                    </li>
                    <li>Read</li>
                </ul>
            </div>
            <hr>
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto flex lg:flex-row flex-col gap-5 mt-10 relative">
        <div class="basis-[70%]">
            <h1 class="text-3xl font-bold text-green-600">{{ $post->title }}</h1>
            <div class="flex gap-5 mt-2 text-sm text-slate-500">
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y') }}
                </div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $post->views }}
                </div>
            </div>
            @if ($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                    class="lg:max-w-[70%] w-full mx-auto mt-4">
            @endif
            <div class="mt-3 prose prose-sm max-w-none w-full">
                {!! $post->content !!}
            </div>
            <livewire:comment :post="$post" />
            <div class="flex flex-col gap-2 mt-5">
                @foreach ($post->comments as $comment)
                    <div wire:key='{{ $comment->id }}' class="rounded border-[1px] border-slate-200 p-3">
                        <h1 class="text-slate-600 font-semibold">{{ $comment->name }}<span
                                class="text-xs text-slate-400 font-normal">
                                - {{ $comment->created_at->diffForHumans() }}</span></h1>
                        <p class="text-slate-500 text-sm">{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @livewire('random-post')
    </section>

    <x-footer />
</div>
