<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="flex items-center">
            <!-- Sidebar toggle button -->
            <div class="lg:hidden m-4 z-10">
                <button id="openSidebar"
                    class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Page title -->
            <div class="flex-shrink-0 flex items-center">
                <img class="h-8 w-8 rounded-full" src="<?= $this->getUrl("templates/default/gfx/profile.png"); ?>"
                    alt="Profile">
            </div>
            <div class="ml-3 flex items-center">
                <span class="text-gray-900 font-medium">
                    <?php
                    if ($contact_id != 0)
                        echo htmlspecialchars($User->findById($contact_id)['username']);
                    else
                        echo "Select a contact";
                    ?>
                </span>
            </div>
        </div>

        <!-- settings dropdown -->
        <div class="flex items-center">
            <div class="flex-shrink-0 relative">
                <button id="settingsDropdown" type="button"
                    class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="sr-only">Open settings</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <div id="settingsMenu"
                    class="origin-top-right z-50 absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                    role="menu" aria-orientation="vertical" aria-labelledby="settingsDropdown">
                    <form method="post" class="block w-full">
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem"><span
                                class="font-bold"><?= htmlspecialchars($_SESSION['user']['username']) ?></span></button>
                    </form>
                    <form method="post" class="block w-full">
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem">Settings <span class="text-red-600 font-bold">(in
                                dev)</span></button>
                    </form>
                    <form method="post" class="block w-full">
                        <button name="logout" type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>