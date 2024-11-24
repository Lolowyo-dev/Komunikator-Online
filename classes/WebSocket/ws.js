const WebSocket = require("ws");

const wss = new WebSocket.Server({ port: 8080 });

// store connected clients with their userIDs
const clients = new Map();

wss.on("connection", (ws) => {
  let userID;

  // listen for messages to set userID
  ws.on("message", (data) => {
    const message = JSON.parse(data);

    // set userID for this connection
    if (message.userID) {
      userID = message.userID;
      clients.set(userID, ws);
      console.log(`User connected: ${userID}`);
    } else if (message.action === "reload" && message.targetID) {
      // send reload message to the target user
      const targetClient = clients.get(message.targetID);
      if (targetClient) {
        targetClient.send(JSON.stringify({ action: "reload" }));
        console.log(`Sent reload to user ${message.targetID}`);
      }
    }
  });

  // handle client disconnect
  ws.on("close", () => {
    console.log(`User disconnected: ${userID}`);
    clients.delete(userID);
  });
});
