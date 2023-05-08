$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      name: $("password").val(),
    };

    $.ajax({
      type: "POST",
      url: "reset_password.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
    });


if (data.success) {

      $("form").html(
          '<div class="alert alert-success">' + "We have updated your password succesfully!"  + "</div>"
        );
}






    event.preventDefault();
  });
});
