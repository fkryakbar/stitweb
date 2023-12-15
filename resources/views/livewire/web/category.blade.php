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
    <section class="lg:w-[60%] w-[95%] mx-auto flex lg:flex-row flex-col gap-5 mt-10 relative">
        <div class="basis-[70%] flex flex-col gap-4">
            @foreach ($posts as $post)
                <a wire:navigate href="/read/{{ $post->slug }}">
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
                            <div class="text-slate-500 text-xs mt-2">
                                {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y') }}
                            </div>
                            <p class="text-sm text-slate-500 mt-4">
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
                    class="lg:flex-1 flex lg:flex-nowrap flex-wrap gap-2 flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
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
