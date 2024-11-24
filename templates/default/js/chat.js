// WebSocket connection
const socket = new WebSocket("ws://localhost:8080");
const messageQueue = []; // Queue for storing messages before the connection is open

// Function to send a message (queues it if the connection isn't ready)
function sendMessage(message) {
  if (socket.readyState === WebSocket.OPEN) {
    socket.send(JSON.stringify(message));
  } else {
    console.log("WebSocket not open. Queuing message:", message);
    messageQueue.push(message);
  }
}

// Function to reload a page for a specific user
function reloadPageFor(targetUserID) {
  const reloadMessage = {
    action: "reload",
    targetID: targetUserID,
  };
  sendMessage(reloadMessage);
}

// Handle WebSocket open event
socket.onopen = () => {
  console.log("WebSocket connection is open.");
  socket.send(JSON.stringify({ userID: userID }));

  // Send any queued messages
  while (messageQueue.length > 0) {
    const queuedMessage = messageQueue.shift();
    socket.send(JSON.stringify(queuedMessage));
    console.log("Sent queued message:", queuedMessage);
  }
};

// Handle WebSocket errors
socket.onerror = (error) => {
  console.error("WebSocket error:", error);
};

// Handle incoming messages
socket.onmessage = (event) => {
  const message = JSON.parse(event.data);
  if (message.action === "reload") {
    console.log("Reloading page...");
    location.reload();
  }
};

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

document.addEventListener("DOMContentLoaded", () => {
  // Sidebar toggle functionality
  const sidebar = document.getElementById("friend-list-sidebar");
  const openSidebarBtn = document.getElementById("openSidebar");
  const closeSidebarBtn = document.getElementById("closeSidebar");

  if (openSidebarBtn && closeSidebarBtn && sidebar) {
    openSidebarBtn.addEventListener("click", () => {
      sidebar.classList.remove("-translate-x-full");
    });

    closeSidebarBtn.addEventListener("click", () => {
      sidebar.classList.add("-translate-x-full");
    });
  }

  // Settings dropdown functionality
  const settingsDropdown = document.getElementById("settingsDropdown");
  const settingsMenu = document.getElementById("settingsMenu");

  if (settingsDropdown && settingsMenu) {
    settingsDropdown.addEventListener("click", (e) => {
      e.stopPropagation();
      settingsMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", (e) => {
      if (
        !settingsDropdown.contains(e.target) &&
        !settingsMenu.contains(e.target)
      ) {
        settingsMenu.classList.add("hidden");
      }
    });
  }

  // Scroll to the bottom of the chat
  const chatMessages = document.getElementById("chat-messages");

  if (chatMessages) {
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  // Auto resize the message input
  const messageInput = document.getElementById("messageInput");
  const sendButton = document.getElementById("sendButton");

  if (messageInput) {
    messageInput.addEventListener("input", function () {
      this.style.height = "auto";

      const newHeight = Math.min(this.scrollHeight, 150);
      this.style.height = `${newHeight}px`;
      if (newHeight == 150) {
        this.style.borderRadius = "24px 0px 0px 24px";
      }
    });
  }

  // Send message on Enter key press
  if (messageInput && sendButton) {
    messageInput.addEventListener("keydown", (e) => {
      if (e.key === "Enter" && !e.shiftKey) {
        e.preventDefault();
        sendButton.click();
      }
    });
  }
});
