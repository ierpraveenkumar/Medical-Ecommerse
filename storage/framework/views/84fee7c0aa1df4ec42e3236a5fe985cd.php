<aside
style="background-color: #381b20;  class="sidebar w-64 md:shadow transform -translate-x-full md:translate-x-0 transition-transform duration-150
  ease-in bg-indigo-500">
    <div class="sidebar-header flex items-center justify-center py-4">
        <div class="inline-flex">
            <a href="#" class="inline-flex flex-row items-center">
                <span class="leading-10 text-gray-100 text-2xl font-bold ml-1 uppercase">
                    <div style="border-radius: 10px; overflow: hidden; border: 2px solid #22ec07; padding: 5px;">
                        <img src="https://as1.ftcdn.net/v2/jpg/03/24/58/44/1000_F_324584485_qtdluDzmBNkJvmntEPlNeG1htwPktgCa.jpg"
                            alt="" style="width: 80px; height: auto;">
                    </div>
                </span>
            </a>
        </div>
    </div>


    <div class="sidebar-content px-4 py-6">
        <ul class="flex flex-col w-full">
            <li class="my-px">
                <a href="<?php echo e(route('admin.dashboard.index')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li class="my-px">
                <a href="<?php echo e(route('admin.manage-lead.index')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </span>
                    <span class="ml-3">Manage Lead</span>
                </a>
            </li>

            <li class="my-px">
                <a href="<?php echo e(route('admin.manage.batch')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </span>
                    <span class="ml-3">Manage Batches</span>
                </a>
            </li>

            <li class="my-px">
                <span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Manage Orders</span>
            </li>
            <li class="my-px">
                <a href="<?php echo e(route('admin.manage.latest.orders')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </span>
                    <span class="ml-3">Manage Latest Orders</span>
                </a>
            </li>
            <li class="my-px">
                <a href="<?php echo e(route('admin.manage.shipped.orders')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </span>
                    <span class="ml-3">Manage Shipped Orders</span>
                </a>
            </li>

            <li class="my-px mt-6">
                <a href="<?php echo e(route('notification')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-gray-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </span>
                    <span class="ml-3">Notifications</span>
                    
                </a>
            </li>

            <li class="my-px">
                <a href="<?php echo e(route('admin.logout')); ?>"
                    class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                    <span class="flex items-center justify-center text-lg text-red-400">
                        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path
                                d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span class="ml-3">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<?php /**PATH /var/www/html/CompletedProjectsSPX066/MedicalEcommerse/resources/views/Components/side-bar.blade.php ENDPATH**/ ?>