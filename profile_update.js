function changeToEditable() {
    var elements = document.querySelectorAll('[name="editable"]');
    var button = document.getElementById('editButton');
  
    if (elements.length > 0) {
      if (elements[0].tagName === 'INPUT') {
        // Elements are already editable, revert to non-editable state
        elements.forEach(function(element) {
          var inputValue = element.value;
          var textElement = document.createElement('span');
          textElement.textContent = inputValue;
          element.parentNode.replaceChild(textElement, element);

        });
  
        button.textContent = 'Edit';
        button.setAttribute('onclick', 'changeToEditable()');
      } else {
        // Elements are non-editable, make them editable while retaining the ids
        elements.forEach(function(element) {
          var old_id = element.id;
          var inputValue = element.textContent;
          var inputElement = document.createElement('input');
          inputElement.type = 'text';
          inputElement.id = old_id;
          console.log (inputElement);
          inputElement.value = inputValue;
          element.parentNode.replaceChild(inputElement, element);

          // Update the onChange event handler
          inputElement.setAttribute('onchange', 'updateProfile(this)');
        });
  
        button.textContent = 'Save';
        button.setAttribute('onclick', 'location.reload();');
      }
    }
  }
  
  function updateProfile(element) {
    console.log (element);
    //Get the value and id from the input field that trigered the function call
    var element_id = element.id;
    var element_value = element.value;
    console.log (element_id);

// Create an object with the data to be sent
var data = {
  field: element_id,
  value: element_value
};

// Send an AJAX POST request to profile_update.php
$.ajax({
  url: 'profile_update.php',
  type: 'POST',
  data: data,
  success: function(response) {
    // Handle the response from the PHP file
    console.log(response);
  },
  error: function(xhr, status, error) {
    // Handle any errors that occur during the AJAX request
    console.error(error);
  }
});



    }