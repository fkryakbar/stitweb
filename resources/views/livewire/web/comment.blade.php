<div class="mt-20">
    <div class="mb-5">
        <h3 class="font-semibold text-green-500 text-2xl">Tinggalkan Komentar</h3>
        <hr class="w-[50px] mt-2 border-amber-400 border-[1px]">
    </div>
    @if (session('comment_status'))
        <div role="alert" class="alert alert-success mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('comment_status') }}</span>
        </div>
    @endif
    <form method="POST" action="" autocomplete="off" wire:submit='save'>
        <textarea class="textarea textarea-bordered w-full @error('comment') textarea-error @enderror" wire:model='comment'
            placeholder="Ketik disini..."></textarea>
        @error('comment')
            <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
        <div class="flex gap-3 mt-3">
            <div class="w-full">
                <input type="text" placeholder="Nama" wire:model='name'
                    class="input input-bordered w-full  @error('name') input-error @enderror" />
                @error('name')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full">
                <input type="Email" placeholder="Alamat Email" wire:model='email'
                    class="input input-bordered w-full @error('email') input-error @enderror" />
                @error('email')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn bg-green-500 hover:bg-green-700 text-white font-semibold mt-3 ">Kirim</button>
    </form>
</div>
