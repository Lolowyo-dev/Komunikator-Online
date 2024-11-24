<?php
// redirect to chat page with choosed friend
if (isset($_POST['friend_id'])) {
    $Controller->redirectPage("/Web/Chat/friend_id/" . $_POST['friend_id']);
}

// accept friend request
if (isset($_POST['accept_request'])) {
    $user2_id = intval($_POST['accept_request']);
    $Friendship->updateRequest($user_id, $user2_id, 'accepted');
?>
    <script>
        reloadPageFor(<?php echo $user_id; ?>);
        reloadPageFor(<?php echo $user2_id; ?>);
    </script>
<?php
}

// reject friend request
if (isset($_POST['reject_request'])) {
    $user2_id = intval($_POST['reject_request']);
    $Friendship->updateRequest($user_id, $user2_id, 'rejected');
?>
    <script>
        reloadPageFor(<?php echo $user_id; ?>);
        reloadPageFor(<?php echo $user2_id; ?>);
    </script>
<?php
}

// search for friends
$searchResults = [];
if (isset($_POST['search_username']) && !empty($_POST['search_username'])) {
    $searchTerm = htmlspecialchars($_POST['search_username']);
    $searchResults = $Friendship->searchAvailableFriends($user_id, $searchTerm);
}

// send friend request
if (isset($_POST['send_request']) && isset($_POST['receiver_id'])) {
    $receiver_id = $_POST['receiver_id'];
    $Friendship->sendRequest($user_id, $receiver_id);
?>
    <script>
        reloadPageFor(<?php echo $user_id; ?>);
        reloadPageFor(<?php echo $receiver_id; ?>);
    </script>
<?php
}
?>

<div class="flex flex-col h-full">
    <div class="p-4 bg-primary text-white flex justify-between items-center">
        <h1 class="text-2xl font-bold">Chats</h1>
        <button id="closeSidebar" class="lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="flex-grow overflow-y-auto p-4 space-y-6">
        <!-- Search Bar Section -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Find Friends</h2>
            <form method="post" class="space-y-2">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                    <input type="text" name="search_username" class="flex-grow p-2 text-gray-700 focus:outline-none"
                        placeholder="Search by username..."
                        value="<?php echo isset($searchTerm) ? htmlspecialchars($searchTerm) : ''; ?>">
                    <button type="submit"
                        class="bg-secondary text-white p-2 hover:bg-primary transition duration-300 h-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
            <?php if (!empty($searchResults)) { ?>
                <div class="mt-4 space-y-2">
                    <?php foreach ($searchResults as $result) { ?>
                        <form method="post" class="flex items-center justify-between bg-gray-100 p-2 rounded-lg">
                            <span><?php echo htmlspecialchars($result['username']); ?></span>
                            <input type="hidden" name="receiver_id" value="<?php echo $result['id']; ?>">
                            <button type="submit" name="send_request"
                                class="bg-primary text-white px-3 py-1 rounded-full text-sm hover:bg-secondary transition duration-300">
                                Add Friend
                            </button>
                        </form>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <!-- Friend Requests Section -->
        <?php
        if (!empty($pendingRequests)) { ?>
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Friend Requests</h2>
                <div class="space-y-2">
                    <?php foreach ($pendingRequests as $request) { ?>
                        <div class="flex items-center justify-between bg-gray-100 p-2 rounded-lg">
                            <span><?php echo htmlspecialchars($request['username']); ?></span>
                            <div class="space-x-2">
                                <form method="post" class="inline">
                                    <button type="submit" name="accept_request"
                                        value="<?php echo htmlspecialchars($request['id']); ?>"
                                        class="bg-green-500 text-white px-3 py-1 rounded-full text-sm hover:bg-green-600 transition duration-300">
                                        Accept
                                    </button>
                                </form>
                                <form method="post" class="inline">
                                    <button type="submit" name="reject_request"
                                        value="<?php echo htmlspecialchars($request['id']); ?>"
                                        class="bg-red-500 text-white px-3 py-1 rounded-full text-sm hover:bg-red-600 transition duration-300">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <!-- Friends List Section -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Friends</h2>
            <?php
            if (!empty($friends)) { ?>
                <div class="space-y-2">
                    <?php foreach ($friends as $friend) { ?>
                        <form method="post">
                            <input type="hidden" name="friend_id" value="<?php echo $friend['id']; ?>">
                            <button type="submit" class="w-full">
                                <div
                                    class="flex items-center space-x-3 bg-white p-3 rounded-lg hover:bg-gray-50 transition duration-300">
                                    <img src="<?= $this->getUrl("templates/default/gfx/profile.png"); ?>" alt="Profile Picture"
                                        class="w-10 h-10 rounded-full">
                                    <span
                                        class="font-medium text-gray-800"><?php echo htmlspecialchars($friend['username']); ?></span>
                                </div>
                            </button>
                        </form>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p class="text-center text-gray-500">No friends yet</p>
            <?php } ?>
        </div>
    </div>
</div>