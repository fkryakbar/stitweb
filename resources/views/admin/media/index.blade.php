@section('title', 'Media')
<x-layouts.admin>
    <main x-data="{ isAddPost: false }">
        <div class="pt-6 px-4">
            <div class="my-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-500" x-show="isAddPost">Upload Media</h1>
                    <h1 class="text-2xl font-bold text-gray-500" x-show="!isAddPost">Media</h1>
                </div>
                <button class="btn bg-blue-500 text-white hover:bg-blue-700" x-on:click="isAddPost=!isAddPost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        x-show="!isAddPost" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" x-show="isAddPost">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </button>
            </div>
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
            </script>
            @if (session()->has('success'))
                <script>
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
            <div class="overflow-x-auto" x-show="!isAddPost">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Filename</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medias as $i => $media)
                            <tr>
                                <th>{{ $i + 1 }}</th>
                                <td>{{ $media->filename }}</td>
                                <td>{{ $media->size }} KB</td>
                                <td class="flex gap-2">
                                    <a href="/storage/{{ $media->path }}" target="_blank"
                                        class="btn bg-green-500 border-0 text-white btn-xs hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <button onclick="copy_link_url('{{ $media->path }}')"
                                        class="btn bg-blue-500 border-0 text-white btn-xs hover:bg-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                                        </svg>
                                    </button>
                                    <button onclick="delete_media('{{ $media->id }}')"
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
                                <span class="font-medium">{{ $medias->firstItem() }}</span>
                                {!! __('to') !!}
                                <span class="font-medium">{{ $medias->lastItem() }}</span>
                                {!! __('of') !!}
                                <span class="font-medium">{{ $medias->total() }}</span>
                                {!! __('results') !!}
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                @if ($medias->onFirstPage())
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                        {!! __('pagination.previous') !!}
                                    </span>
                                @else
                                    <a href="{{ $medias->previousPageUrl() }}" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                        {!! __('pagination.previous') !!}
                                    </a>
                                @endif

                                @for ($page = 1; $page <= $medias->lastPage(); $page++)
                                    @if ($page == $medias->currentPage())
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                                    @else
                                        <a href="{{ $medias->url($page) }}"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                                    @endif
                                @endfor

                                @if ($medias->hasMorePages())
                                    <a href="{{ $medias->nextPageUrl() }}" rel="next"
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
            <form action="" method="POST" autocomplete="off" enctype="multipart/form-data" x-show="isAddPost">
                <div class="">
                    <div class="">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Upload :</span>
                            </div>
                            <input type="file" name="file"
                                class="file-input file-input-bordered w-full max-w-xs @error('file') file-input-error @enderror" />
                            @error('file')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>
                @csrf
                <button id="submit" type="submit"
                    class="btn mt-5 bg-green-500 text-white border-0 hover:bg-green-700">Upload</button>
            </form>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_media(id) {
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
                    window.location.href = '/admin/media/' + id + '/delete';
                }
            });
        }

        function copy_link_url(path) {
            navigator.clipboard.writeText(`{{ env('APP_URL') }}/storage/${path}`)
                .then(() => {
                    Toast.fire({
                        icon: "success",
                        title: "Link copied"
                    });
                })
                .catch(err => {
                    console.error('Could not copy text: ', err);
                });
        }
    </script>
</x-layouts.admin>
