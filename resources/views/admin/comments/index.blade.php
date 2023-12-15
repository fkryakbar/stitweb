@section('title', 'Comments')
<div>
    <main>
        <div class="pt-6 px-4">
            <div class="my-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-500">Comments</h1>
                </div>
            </div>
            @if (session()->has('success'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "{{ session('success') }}"
                    });
                </script>
            @endif
            @error('posts_still_exist')
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "{{ $message }}"
                    });
                </script>
            @enderror
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Post Title</th>
                            <th class="text-center">Visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $i => $comment)
                            <tr wire:key='{{ $comment->id }}'>
                                <th>{{ $i + 1 }}</th>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    <a href="/read/{{ $comment->post->slug }}" class="text-green-500 underline"
                                        target="_blank">{{ $comment->post->title }}</a>
                                </td>
                                <td class="">
                                    <div class="flex gap-2 items-center justify-center">
                                        <div class="text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <input type="radio" name="radio-{{ $comment->id }}"
                                                class="radio radio-success" @checked($comment->is_public == 1)
                                                wire:click='updateVisibility({{ $comment->id }}, true)' />
                                            <input type="radio" name="radio-{{ $comment->id }}"
                                                class="radio radio-warning" @checked($comment->is_public == 0)
                                                wire:click='updateVisibility({{ $comment->id }}, false)' />
                                        </div>
                                        <div class="text-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                                <td class="flex gap-2">
                                    <button type="button" wire:click="delete({{ $comment->id }})"
                                        wire:confirm="Are you sure you want to delete this comment?"
                                        class="btn bg-red-500 border-0 text-white btn-xs hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-between px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div
                        class="lg:flex-1 flex lg:flex-nowrap flex-wrap gap-2 flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 leading-5">
                                {!! __('Showing') !!}
                                <span class="font-medium">{{ $comments->firstItem() }}</span>
                                {!! __('to') !!}
                                <span class="font-medium">{{ $comments->lastItem() }}</span>
                                {!! __('of') !!}
                                <span class="font-medium">{{ $comments->total() }}</span>
                                {!! __('results') !!}
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                @if ($comments->onFirstPage())
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                        {!! __('pagination.previous') !!}
                                    </span>
                                @else
                                    <a href="{{ $comments->previousPageUrl() }}" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                        {!! __('pagination.previous') !!}
                                    </a>
                                @endif

                                @for ($page = 1; $page <= $comments->lastPage(); $page++)
                                    @if ($page == $comments->currentPage())
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                                    @else
                                        <a href="{{ $comments->url($page) }}"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                                    @endif
                                @endfor

                                @if ($comments->hasMorePages())
                                    <a href="{{ $comments->nextPageUrl() }}" rel="next"
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

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_comment(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/categories/' + id + '/delete';
                }
            });
        }
    </script>
</div>
