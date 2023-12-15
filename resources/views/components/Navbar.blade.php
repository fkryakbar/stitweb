<nav class="items-center bg-green-700 min-h-[64px]">
    <div class="lg:flex justify-between items-center lg:w-[80%] mx-auto w-[95%] pt-1">
        <div class="flex justify-between items-center">
            <a class="btn btn-ghost" href="/" wire:navigate>
                <img src="{{ Vite::asset('resources/assets/logo.png') }}" alt="logo" class="w-[150px]">
            </a>
            <div class="mr-3 text-white lg:hidden block">
                <button class="btn btn-ghost" x-on:click="open=!open">
                    <svg x-show="open==false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
        </div>
        <div class="flex lg:hidden flex-col lg:flex-row lg:p-0 p-5  gap-5 text-white font-semibold lg:text-base text-sm"
            :class="open ? '' : 'hidden'">
            <x-navbarmenu />
        </div>
        <div
            class="lg:flex hidden flex-col lg:flex-row lg:p-0 p-5  gap-5 text-white font-semibold lg:text-base text-sm">
            <x-navbarmenu />
        </div>
    </div>
</nav>
