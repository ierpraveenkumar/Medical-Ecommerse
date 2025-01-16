<header class="header" style="background-color: #430b77; box-shadow: 0 4px 6px rgba(252, 31, 31, 0.1); padding: 1rem;">
    <div class="header-content flex items-center flex-row">
        <div class="flex ml-auto">
            <div class="my-px mr-6">
                <a href="<?php echo e(route('notification')); ?>" class="flex flex-row items-center h-10 px-3 rounded-lg text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </span>
                    <span class="ml-3"><b>Notifications</b></span>
                    
                </a>
            </div>


            
            <span class="flex flex-row items-center">
                <img src="https://as2.ftcdn.net/v2/jpg/02/29/75/83/1000_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg"
                    alt class="h-10 w-10 bg-gray-200 border rounded-full" />
            
                <div class="relative ml-2">
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        <?php echo e(\App\Models\Admin::find(session('login_id'))->name ?? 'John Doe'); ?>

                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
            
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute top-full right-0 mt-2">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="<?php echo e(route('admin.dashboard.index')); ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.logout')); ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </span>
            
            <script>
                // JavaScript to handle the dropdown toggle
                document.getElementById('dropdownDefaultButton').addEventListener('click', function () {
                    var dropdown = document.getElementById('dropdown');
                    dropdown.classList.toggle('hidden');
                });
            
                // Close dropdown if user clicks outside of it
                window.addEventListener('click', function (event) {
                    var dropdown = document.getElementById('dropdown');
                    if (!event.target.matches('#dropdownDefaultButton')) {
                        if (!dropdown.classList.contains('hidden')) {
                            dropdown.classList.add('hidden');
                        }
                    }
                });
            </script>
            
        </div>
    </div>
</header>
<?php /**PATH /var/www/html/CompletedProjectsSPX066/admin_panel/resources/views/Components/header.blade.php ENDPATH**/ ?>