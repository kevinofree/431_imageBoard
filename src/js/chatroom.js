var $main = function() {

  function processChatMessage() {

    var chatMessage = $('#chat-input').val();
    var roomID = $('#room-id').val();
    var roomName = $('#room-name').val();

    console.log(roomID);
    console.log(roomName);
    console.log(chatMessage);

    var sendData = 'chat-text=' + chatMessage + '&' + 'room-id=' + roomID + '&' + 'room-name=' + roomName;
    console.log(sendData);

    // Clear the chat input field
    $('#chat-input').val('');

    // Create new xhr object
    var xhr = new XMLHttpRequest();

    // Open a POST request with the URL request-chatlog.php. Set to TRUE for an asynchronous request
    xhr.open('POST', 'request-chatlog.php', true);

    // Set the content headers for the request
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    // Define on ready state change. This function gets called every time readyState changes.
    // It is a XML HTTP Object function.
    xhr.onreadystatechange = function() {

      // Output readystate
      console.log('readyState : ' + xhr.readyState);

      // Check for ready date 2, request sent, received by server
      if(xhr.readyState == 2) {
        console.log("Loading....");
      }

      // Check for ready state 4 and stutus code 200, reponse complete (sucess or failure)
      if(xhr.readyState == 4 && xhr.status == 200) {
        console.log('XHR response text: ' + xhr.responseText);

        /*
          Use jQuery to display new chats here ..
        */

      }
    }

    // Send the asynchronous request
    xhr.send(sendData);
  }


  // Listens when the user clicks on the send button
  $('#sendChat').on('click', function() {
    processChatMessage();
  });

  // Listens when the user presses enter on the keyboard
  $('#chat-input').on('keypress', function(event) {
    if(event.keyCode === 13) {
      processChatMessage();
    }
  });
};
$(document).ready($main);
