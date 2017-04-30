var $main = function() {

  function get_chatlog_ajax_request() {

    // Create new xhr object
    var xhr = new XMLHttpRequest();

    // Open a POST request with the URL request-chatlog.php. Set to TRUE for an asynchronous request
    xhr.open('POST', 'request-chatlog.php', true);

    // Set the content headers for the AJAX request
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    // Define on ready state change. This function gets called every time readyState changes.
    // It is a XML HTTP Object function.
    xhr.onreadystatechange = function() {

      // Output readystate
      console.log('readyState : ' + xhr.readyState);

      // Check for ready state 2, request sent, received by server
      if(xhr.readyState == 2) {
        console.log("Loading....");
      }

      // Check for ready state 4 and stutus code 200, reponse complete (sucess or failure)
      if(xhr.readyState == 4 && xhr.status == 200) {

        //Parse the JSON Object
        var display = JSON.parse(xhr.responseText);
        var len = display.chatlog.length;

        // Post the entire history of the chat
        for(var i = 0; i < len; i++) {

          var listBegin = '<li class="left clearfix">';
          var spanBegin = '<span class="chat-img pull-left">';
          var image = '<img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />';
          var spanEnd = '</span>';
          var chatBodyBegin = '<div class="chat-body clearfix">';
          var chatHeaderBegin = '<div class="header">';
          var strongUsername = '<strong class="primary-font">' + display.chatlog[i].chatSentBy + '</strong>';
          var smallMutedBegin = '<small class="pull-right text-muted">';
          var glyph = '<span class="glyphicon glyphicon-time"></span>';
          var timeSent = 'sent: ' + display.chatlog[i].chatTimeSent;
          var smallMutedEnd = '</small>';
          var chatHeaderEnd = '</div>'
          var messageParaBegin = '<p>';
          var userMessage = display.chatlog[i].chatText;
          var messageParaEnd = '</p>';
          var chatBodyEnd = '</div>';
          var listEnd = '</li>';

          var insertMessage = listBegin + spanBegin + image + spanEnd + chatBodyBegin;
          insertMessage += chatHeaderBegin + strongUsername + smallMutedBegin + glyph;
          insertMessage += timeSent + smallMutedEnd + chatHeaderEnd + messageParaBegin;
          insertMessage += userMessage + messageParaEnd + chatBodyEnd + listEnd;

          // append to the chat area
          $('#chat').append(insertMessage);
        }
      }
    }

    // Send the asynchronous request
    xhr.send();
  }


























  /*
      This request gets the chat information and sends to the PHP server script.
      The PHP server script saves the chat information into the database, then
      repsonseds with the entire history of the chatlog asynchronously.
  */
  function send_chat_ajax_request() {

    var chatMessage = $('#chat-input').val();
    var roomID = $('#room-id').val();
    var roomName = $('#room-name').val();

    console.log(roomID);
    console.log(roomName);
    console.log(chatMessage);

    var sendData = 'chat-text=' + chatMessage + '&' + 'room-id=' + roomID + '&' + 'room-name=' + roomName;
    console.log(sendData);

    // Create new xhr object
    var xhr = new XMLHttpRequest();

    // Open a POST request with the URL request-chatlog.php. Set to TRUE for an asynchronous request
    xhr.open('POST', 'request-chatlog.php', true);

    // Set the content headers for the AJAX request
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    // Define on ready state change. This function gets called every time readyState changes.
    // It is a XML HTTP Object function.
    xhr.onreadystatechange = function() {

      // Output readystate
      console.log('readyState : ' + xhr.readyState);

      // Check for ready state 2, request sent, received by server
      if(xhr.readyState == 2) {
        console.log("Loading....");
      }

      // Check for ready state 4 and stutus code 200, reponse complete (sucess or failure)
      if(xhr.readyState == 4 && xhr.status == 200) {

        //Parse the JSON Object
        var display = JSON.parse(xhr.responseText);
        var len = display.chatlog.length;

        // Only post the most recent chat
        var listBegin = '<li class="left clearfix">';
        var spanBegin = '<span class="chat-img pull-left">';
        var image = '<img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />';
        var spanEnd = '</span>';
        var chatBodyBegin = '<div class="chat-body clearfix">';
        var chatHeaderBegin = '<div class="header">';
        var strongUsername = '<strong class="primary-font">' + display.chatlog[len - 1].chatSentBy + '</strong>';
        var smallMutedBegin = '<small class="pull-right text-muted">';
        var glyph = '<span class="glyphicon glyphicon-time"></span>';
        var timeSent = 'sent: ' + display.chatlog[len - 1].chatTimeSent;
        var smallMutedEnd = '</small>';
        var chatHeaderEnd = '</div>'
        var messageParaBegin = '<p>';
        var userMessage = display.chatlog[len - 1].chatText;
        var messageParaEnd = '</p>';
        var chatBodyEnd = '</div>';
        var listEnd = '</li>';

        var insertMessage = listBegin + spanBegin + image + spanEnd + chatBodyBegin;
        insertMessage += chatHeaderBegin + strongUsername + smallMutedBegin + glyph;
        insertMessage += timeSent + smallMutedEnd + chatHeaderEnd + messageParaBegin;
        insertMessage += userMessage + messageParaEnd + chatBodyEnd + listEnd;

        // append to the chat area
        $('#chat').append(insertMessage);

        // Clear the previous value in the chat input
        $('#chat-input').val('');
      }
    }

    // Send the asynchronous request
    xhr.send(sendData);
  }

  /*
    NOTES:

    //Call the yourAjaxCall() function every 1000 millisecond

    setInterval("yourAjaxCall()", 1000);
    function yourAjaxCall(){...}

    MORE INFO
    var ajax_call = function() {
      //your jQuery ajax code
    };

    var interval = 1000 * 60 * X; // where X is your every X minutes

    setInterval(ajax_call, interval);


  */


  // Listens when the user clicks on the send button
  $('#sendChat').on('click', function() {
    send_chat_ajax_request();
  });

  // Listens when the user presses enter on the keyboard
  $('#chat-input').on('keypress', function(event) {
    if(event.keyCode === 13) {
      send_chat_ajax_request();
    }
  });
};

$(document).ready($main);
