import $ from "jquery";
import { parse_json } from "./parse_json";

export const Login = function() {
  var form = $("#login");
  form.submit(function(event) {
    event.preventDefault();

    $.ajax({
      url: "post/login.php",
      data: form.serialize(),
      method: "POST",
      success: function(data) {
        var json = parse_json(data);
        if (json.ok) {
          if (json.author) {
            window.location.assign("./author.php");
          } else {
            window.location.assign("./");
          }
        } else {
          alert(json.message);
        }
      },
      error: function(xhr, status, error) {
        alert("Error: " + error);
      }
    });
  });
};
