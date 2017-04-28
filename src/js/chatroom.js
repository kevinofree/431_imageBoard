var $main = function() {

  /*
    Notes:
    Use sessions in the PHP to track which user has signed onto the chatroom

  */

  // Request an HTTP GET Ajax call to the server to retrieve chatlogs
  function getChatLog() {
    $.ajax({
      method : 'GET', // This link depends on the folder structure of the server
      url : 'http://localhost:8080/apps/s28/GyroChan/431_imageBoard/src/request-chatlog.php',
      contentType : 'application/json',
      dataType: 'json',
      success : function(data) {
        console.log(data);
      }
    });
  }

  // Gets call intially when the user first logs into the chatroom
  getChatLog();

  // Listens when the user clicks on the send button
  $('#sendChat').on('click', function() {
    getChatLog();
  });

  // Listens when the user presses enter on the keyboard
  $('#chat-input').on('keypress', function(event) {
    if(event.keyCode === 13) {
      getChatLog();
    }
  });
};
$(document).ready($main);
