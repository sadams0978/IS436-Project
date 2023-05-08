  $(document).ready(function() {
    // Attach a click event handler to the copy button
    $('#copyButton').click(function() {
      // Make an AJAX request to fetch the value from /profile/link.php
      $.ajax({
        url: '/profile/link.php',
        type: 'GET',
        success: function(response) {
          // Create a temporary textarea element to hold the value
          var $tempTextArea = $('<textarea>');
          // Set the value of the textarea to the response received from the server
          $tempTextArea.text(response);
          // Append the textarea to the document
          $('body').append($tempTextArea);
          // Copy the value from the textarea to the clipboard
          $tempTextArea.select();
          document.execCommand('copy');
          // Remove the temporary textarea from the document
          $tempTextArea.remove();
          // Display a success message showing that the link has been copied
          alert("We copied the link to your clipboard");
	},
        error: function() {
          // Display an error message if the AJAX request fails
          alert('Failed to generate a link');
        }
      });
    });
  });
