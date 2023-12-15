@section('title', 'Edit Category')
<x-layouts.admin>

    <main>
        <div class="pt-6 px-4">
            <div class="my-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-500">Update Category</h1>
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
            <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="">
                    <div class="">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Name</span>
                            </div>
                            <input type="text" name="name" placeholder="Category Name"
                                value="{{ $category->name }}"
                                class="input input-bordered w-full max-w-xs @error('name') input-error @enderror " />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                </div>
                @csrf
                <button id="submit" type="submit"
                    class="btn mt-5 bg-green-500 text-white border-0 hover:bg-green-700">Update
                    Category</button>
            </form>

        </div>
    </main>
</x-layouts.admin>
