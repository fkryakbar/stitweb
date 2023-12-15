<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script defer src="https://demo.themesberg.com/windster/app.bundle.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/super-build/ckeditor.js"></script>
    @vite(['resources/css/app.css'])
    @yield('head')
    <title>@yield('title')</title>
</head>

<body>
    <div class="fixed bg-white w-full h-screen z-[500]" id="loader">
        <div class="flex justify-center items-center h-screen">
            <div class="flex flex-col items-center mx-4">
                <span class="loading loading-ring loading-lg text-green-500"></span>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 1200);
        }
    </script>
    <div>
        <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
                            class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                            <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <a href="/" class="text-xl font-bold flex items-center lg:ml-2.5 gap-3">
                            <img src="{{ Vite::asset('resources/assets/main-logo.png') }}" class="w-[35px]" />
                            <span class="self-center
                                whitespace-nowrap">Admin
                                Page</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <button id="toggleSidebarMobileSearch" type="button"
                            class="lg:hidden text-gray-500 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg">
                            <span class="sr-only">Search</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <a href="/logout"
                            class="hidden sm:inline-flex ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="flex overflow-hidden bg-white pt-16">
            <aside id="sidebar"
                class="fixed hidden z-20 h-screen top-0 left-0 pt-16  lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
                aria-label="Sidebar">
                <div class="relative h-screen flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
                    <div class="h-screen flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex-1  px-3 bg-white divide-y space-y-1">
                            <ul class="space-y-2 pb-2">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="text-base text-gray-500 hover:font-semibold  rounded-lg flex items-center p-2 hover:bg-gray-100 group @if (Request::is('admin/dashboard*')) bg-gray-100 font-semibold @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        <span class="ml-3">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('posts') }}"
                                        class="text-base text-gray-500 hover:font-semibold rounded-lg hover:bg-gray-100 flex items-center p-2 group @if (Request::is('admin/posts*')) bg-gray-100 font-semibold @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                        </svg>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Posts</span>

                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('categories') }}"
                                        class="text-base text-gray-500 hover:font-semibold rounded-lg hover:bg-gray-100 flex items-center p-2 group @if (Request::is('admin/categories*')) bg-gray-100 font-semibold @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6h.008v.008H6V6z" />
                                        </svg>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Category</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('comments') }}"
                                        class="text-base text-gray-500 hover:font-semibold rounded-lg hover:bg-gray-100 flex items-center p-2 group @if (Request::is('admin/comments*')) bg-gray-100 font-semibold @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                        </svg>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Comments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('media') }}"
                                        class="text-base text-gray-500 hover:font-semibold rounded-lg hover:bg-gray-100 flex items-center p-2 group @if (Request::is('admin/media*')) bg-gray-100 font-semibold @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <span class="ml-3 flex-1 whitespace-nowrap">Media</span>
                                    </a>
                                </li>
                            </ul>
                            <a href="/logout"
                                class="lg:hidden block  text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm  py-2.5 text-center items-center  w-full">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
            <div id="main-content" class="h-screen w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
                {{ $slot }}

                <p class="text-center text-sm text-gray-500 my-10">
                    &copy; {{ date('Y') }} <a href="/" class="hover:underline">STIT
                        Assunniyyah Tambarangan</a>. All
                    rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
