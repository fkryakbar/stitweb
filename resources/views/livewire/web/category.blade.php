@section('title', $category->name . ' - STIT Assunniyyah Tambarangan')

@section('description')
    Situs Resmi STIT Assunniyyah Tambarangan. Berisi Informasi atau berita terbaru tentang STIT
    Assunniyyah Tambarangan
@endsection
<div>
    <section class="bg-[url('kampus.jpg')] h-[220px] bg-center bg-no-repeat bg-cover bg-fixed relative">
        <div class="bg-green-600 h-[220px] w-full opacity-70 absolute">
        </div>
        <div class="absolute w-full">
            <div class="mt-10 flex flex-col p-5">
                <div class="lg:w-[60%] lg:mx-auto mt-4 border-l-[2px] pl-2 border-amber-400">
                    <h1 class="lg:text-5xl text-3xl font-bold text-white">{{ $category->name }}
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="lg:w-[60%] w-[95%] mx-auto">
        <div class="mt-2">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li><a href="/" wire:navigate>Beranda</a></li>
                    <li><a>Category</a></li>
                    <li>{{ $category->name }}</li>
                </ul>
            </div>
            <hr>
        </div>
    </section>
    <div class="lg:w-[60%] w-[95%] mx-auto mt-10">
        @if (Str::length($search_query) >= 3)
            <p class="text-sm text-gray-700 mb-2">Search Result for <span class="font-bold">{{ $search_query }}</span>
            </p>
        @endif
        <p class="text-sm text-gray-700 leading-5">
            {!! __('Showing') !!}
            <span class="font-medium">{{ $posts->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $posts->lastItem() }}</span>
            {!! __('of') !!}
            <span class="font-medium">{{ $posts->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>
    <section class="lg:w-[60%] w-[95%] mx-auto flex lg:flex-row flex-col gap-5 relative mt-5">
        <div class="basis-[70%] flex flex-col gap-4">
            @foreach ($posts as $post)
                <a wire:key='{{ $post->id }}' wire:navigate href="/read/{{ $post->slug }}">
                    <div class="flex lg:flex-row flex-col gap-4">
                        @if ($post->image_path)
                            <div class="basis-[30%]">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="thumbnail">
                            </div>
                        @endif
                        <div class="basis-[70%]">
                            <h2 class="text-xl font-bold text-green-600">
                                {{ $post->title }}
                            </h2>
                            <div class="text-slate-500 text-xs mt-2 flex gap-4">
                                <p class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    {{ $post->readable_time_format() }}
                                </p>
                                <p class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $post->views }}
                                </p>
                            </div>
                            <p class="text-sm text-slate-500 mt-4 line-clamp-3">
                                {{ $post->description }}
                            </p>
                            <button class="btn bg-amber-400 border-0 mt-5 text-white hover:bg-amber-700">Read
                                More</button>
                        </div>
                    </div>
                    <hr class="mt-3">
                </a>
            @endforeach
            <div class="flex items-center justify-between px-4 py-3 border-gray-200 sm:px-6">
                <div
                    class="lg:flex-1 flex lg:flex-nowrap flex-wrap gap-2 flex-col lg:flex-row lg:items-center lg:justify-center">
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            @if ($posts->onFirstPage())
                                <span
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                    {!! __('pagination.previous') !!}
                                </span>
                            @else
                                <a wire:navigate href="{{ $posts->previousPageUrl() }}" rel="prev"
                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                    {!! __('pagination.previous') !!}
                                </a>
                            @endif

                            @for ($page = 1; $page <= $posts->lastPage(); $page++)
                                @if ($page == $posts->currentPage())
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                                @else
                                    <a wire:navigate href="{{ $posts->url($page) }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                                @endif
                            @endfor

                            @if ($posts->hasMorePages())
                                <a wire:navigate href="{{ $posts->nextPageUrl() }}" rel="next"
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-r-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                    {!! __('pagination.next') !!}
                                </a>
                            @else
                                <span
                                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-r-md">
                                    {!! __('pagination.next') !!}
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @livewire('random-post')
    </section>

    <x-footer />
</div>
