import $ from 'jquery';
import {parse_json} from './parse_json';

export const Admin = function() {

    $("form#add-category").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-category.php",
            data: $(this).serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
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

    $("form#add-topic").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-topic.php",
            data: $(this).serialize(),
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
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
