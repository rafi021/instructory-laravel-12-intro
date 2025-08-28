<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img class="h-8 w-auto"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" />
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{ route('tasks.index') }}"
                            class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                            aria-current="page">Tasks</a>
                        <a href="{{ route('products.index') }}"
                            class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                            aria-current="page">Products</a>
                    </div>
                </div>
            </div>

            {{-- Notification Icon --}}
            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                <div class="relative">
                    <button id="notificationBtn" class="relative focus:outline-none">
                        <i class="fa fa-bell text-white text-2xl"></i>
                        @if (\App\Models\User::first()->unreadNotifications->count())
                            <span
                                class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-500 rounded-full border-2 border-gray-800"></span>
                        @endif
                    </button>
                    <div id="notificationDropdown"
                        class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 hidden">
                        <div class="py-2 px-4 border-b font-semibold text-gray-700">
                            Notifications
                        </div>
                        <div class="max-h-72 overflow-y-auto" id="notificationList">
                            @forelse(\App\Models\User::first()->unreadNotifications as $notification)
                                <div class="px-4 py-3 border-b hover:bg-gray-50 text-gray-800 text-sm">
                                    {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-6 text-center text-gray-400 text-sm">
                                    No new notifications.
                                </div>
                            @endforelse
                        </div>
                        <div class="py-2 px-4 text-right">
                            <form method="GET" action="{{ route('notifications.markAllRead') }}">
                                @csrf
                                <button type="submit" class="text-xs text-blue-600 hover:underline">Mark all as
                                    read</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <a href="{{ route('tasks.index') }}"
                class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                aria-current="page">Tasks</a>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        // Notification dropdown vanilla JS
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('notificationBtn');
            const dropdown = document.getElementById('notificationDropdown');

            if (btn && dropdown) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                // Hide dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    <script type="module">
       window.Echo.channel('orders')
    .listen('.order-placed', (data) => {
        console.log('Order status updated: ', data);

        // Find the notification list
        var notificationList = document.getElementById('notificationList');

        // Remove "No new notifications." if present
        var emptyMsg = notificationList.querySelector('.text-center.text-gray-400');
        if (emptyMsg) emptyMsg.remove();

        // Prepend the new notification
        notificationList.insertAdjacentHTML('afterbegin',
            `<div class="px-4 py-3 border-b hover:bg-gray-50 text-gray-800 text-sm">
                ${data.message}
                <div class="text-xs text-gray-400 mt-1">Just now</div>
            </div>`
        );

        // Optionally, show the red dot badge
        let bell = document.querySelector('#notificationBtn .fa-bell');
        let badge = document.querySelector('#notificationBtn .absolute');
        if (!badge) {
            let span = document.createElement('span');
            span.className = "absolute top-0 right-0 inline-block w-3 h-3 bg-red-500 rounded-full border-2 border-gray-800";
            document.getElementById('notificationBtn').appendChild(span);
        }
    });
    </script>
@endpush
