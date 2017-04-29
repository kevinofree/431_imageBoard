var $main = function() {
  /*
    Notes:
    Use sessions in PHP to track which user has signed onto the chatroom
  */

  function processChatMessage(callback) {

    var chatMessage = $('#chat-input').val();
    var roomID = $('#room-id').val();
    var roomName = $('#room-name').val();

    console.log(roomID);
    console.log(roomName);
    console.log(chatMessage);

    var sendData = {
      "room-id" : roomID,
      "room-name" : roomName,
      "chat-text" : chatMessage
    };

    console.log(sendData);

    $('#chat-input').val('');

  }

  // Request an HTTP GET Ajax call to the server to retrieve chatlogs
  function getChatLog() {
    $.ajax({
      method : 'POST', // This link depends on the folder structure of the server
      url : 'http://localhost:8080/apps/s28/GyroChan/431_imageBoard/src/request-chatlog.php',
      contentType : 'application/json',
      dataType: 'json',
      success : function(data) {
        console.log(data);
      }
    });
  }

  // Gets called intially when the user first logs into the chatroom
  //getChatLog();

  // Listens when the user clicks on the send button
  $('#sendChat').on('click', function() {
    processChatMessage(getChatLog());
  });

  // Listens when the user presses enter on the keyboard
  $('#chat-input').on('keypress', function(event) {
    if(event.keyCode === 13) {
      processChatMessage(getChatLog());
    }
  });
};
$(document).ready($main);
