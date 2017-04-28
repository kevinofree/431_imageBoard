var $main = function() {

  // Listens when the user clicks on the send button
  $('#sendChat').on('click', function() {
    console.log("hello click button");

  });

  // Listens when the user presses enter on the keyboard
  $('#chat-input').on('keypress', function() {

    if(event.keyCode === 13) {
      console.log("hello enter button");
    }

  });
};
$(document).ready($main);
