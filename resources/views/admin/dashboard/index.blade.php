@section('title', 'Dashboard')
<x-layouts.admin>

    <main>
        <div class="pt-6 px-4">
            <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">0</span>
                            <h3 class="text-base font-normal text-gray-500">Posts</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">0</span>
                            <h3 class="text-base font-normal text-gray-500">Comments</h3>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">0</span>
                            <h3 class="text-base font-normal text-gray-500">Announcements</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-layouts.admin>
