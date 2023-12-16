<div>
    @if ($is_show_search_bar)
        <div class="join mb-4">
            <div>
                <div>
                    <input class="input input-bordered join-item w-full" placeholder="Search" wire:model='query' />
                    @error('query')
                        <p class="text-red-500 text-xs">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <button class="btn join-item bg-green-500 text-white hover:bg-green-700" wire:click='search'>Cari</button>
        </div>
    @endif
</div>
