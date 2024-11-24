<main>
    <!-- friend list -->
    <aside id="friend-list-sidebar"
        class="w-64 z-50 min-w-fit bg-white shadow-lg h-full overflow-y-auto transition-transform duration-300 ease-in-out transform lg:translate-x-0 -translate-x-full">
        <?php include("templates/default/components/friends.php"); ?>
    </aside>

    <!-- chat window -->
    <div class="chat-wraper">
        <!-- chat navigation -->
        <nav class="bg-white shadow-sm">
            <?php include("templates/default/components/nav.php"); ?>
        </nav>

        <!-- chat messages -->
        <div id="chat-messages">
            <?php include("templates/default/components/messages.php"); ?>
        </div>
    </div>
</main>