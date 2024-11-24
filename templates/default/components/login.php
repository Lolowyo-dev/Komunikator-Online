<div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">
        Login to your account
    </h2>
</div>

<?php if ($err_message) : ?>
    <div class="text-white text-center mt-4 bg-red-400"><?= $err_message ?></div>
<?php endif; ?>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" method="POST">
        <div>
            <div class="flex items-center justify-between">
                <label for="login" class="block text-sm/6 font-medium text-gray-900">Login</label>
            </div>
            <div class="mt-2">
                <input id="login" name="login" type="text" autocomplete="login" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
            </div>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
            </div>
        </div>

        <div>
            <button type="submit" name="form_type" value="login"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Login
            </button>
        </div>
    </form>
</div>