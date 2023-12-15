<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>ADMIN PAGE LOGIN</title>
</head>

<body class="bg-slate-50">
    <section class="h-screen flex justify-center items-center">
        <div class="rounded-md border-[1px] border-gray-200 py-4 p-4 lg:w-[400px] w-full bg-white mx-3 shadow-md">
            <img class="w-[100px] mx-auto my-5" src="{{ Vite::asset('resources/assets/main-logo.png') }}" alt="Logo">
            <h1 class="font-bold text-2xl text-center">ADMIN LOGIN</h1>
            <form class="my-4" action="" method="POST" autocomplete="off">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" placeholder="Type here" name="username"
                        class="input input-bordered w-full @error('username') input-error @enderror" />
                    @error('username')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Type here"
                        class="input input-bordered w-full @error('password') input-error @enderror" />
                    @error('password')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn bg-green-500 text-white hover:bg-green-700 w-full mt-3">Login</button>
            </form>
            <h1 class="text-slate-400 text-center">Maintenance by TIM Humas</h1>
            <h1 class="text-slate-400 text-center">Copyright @ {{ date('Y') }} STIT Assunniyyah Tambarangan</h1>
        </div>
    </section>
</body>

</html>
