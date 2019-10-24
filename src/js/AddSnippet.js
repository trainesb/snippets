import $ from 'jquery';
import {parse_json} from './parse_json';

export const AddSnippet = function() {

    $("#add-snippet").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-snippet.php",
            data: $(this).serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    alert("New Snippet Added!");
                    window.location.reload();
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
