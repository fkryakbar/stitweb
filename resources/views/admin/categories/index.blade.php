@section('title', 'Categories')
<x-layouts.admin>
    <main x-data="{ isAddPost: false }">
        <div class="pt-6 px-4">
            <div class="my-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-500" x-show="isAddPost">Create Category</h1>
                    <h1 class="text-2xl font-bold text-gray-500" x-show="!isAddPost">Categories</h1>
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
            <div class="overflow-x-auto" x-show="!isAddPost">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Post Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $i => $category)
                            <tr>
                                <th>{{ $i + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ count($category->posts) }}</td>
                                <td class="flex gap-2">
                                    <a href="/admin/categories/{{ $category->id }}"
                                        class="btn bg-green-500 border-0 text-white btn-xs hover:bg-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    <button onclick="delete_category('{{ $category->id }}')"
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
                                <span class="font-medium">{{ $categories->firstItem() }}</span>
                                {!! __('to') !!}
                                <span class="font-medium">{{ $categories->lastItem() }}</span>
                                {!! __('of') !!}
                                <span class="font-medium">{{ $categories->total() }}</span>
                                {!! __('results') !!}
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                @if ($categories->onFirstPage())
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-l-md">
                                        {!! __('pagination.previous') !!}
                                    </span>
                                @else
                                    <a href="{{ $categories->previousPageUrl() }}" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                                        {!! __('pagination.previous') !!}
                                    </a>
                                @endif

                                @for ($page = 1; $page <= $categories->lastPage(); $page++)
                                    @if ($page == $categories->currentPage())
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-100 border border-blue-300 cursor-default leading-5">{{ $page }}</span>
                                    @else
                                        <a href="{{ $categories->url($page) }}"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:bg-gray-100 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">{{ $page }}</a>
                                    @endif
                                @endfor

                                @if ($categories->hasMorePages())
                                    <a href="{{ $categories->nextPageUrl() }}" rel="next"
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
                                <span class="label-text">Name</span>
                            </div>
                            <input type="text" name="name" placeholder="Category Name"
                                class="input input-bordered w-full max-w-xs @error('name') input-error @enderror"
                                value="{{ old('name') }}" />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>
                @csrf
                <button id="submit" type="submit"
                    class="btn mt-5 bg-green-500 text-white border-0 hover:bg-green-700">Create
                    Category</button>
            </form>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_category(id) {
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
</x-layouts.admin>
