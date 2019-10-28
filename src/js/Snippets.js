import $ from 'jquery';
import {parse_json} from './parse_json';

export const Snippet = function() {

    $("button.add-snip").click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-snip.php",
            data: {snippets_id: this.value, tag : this.name, text: ''},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if(!json.ok) {
                    alert(json.message);
                } else {
                    window.location.reload();
                }
            }
        });
    });

    $("input.title").change(function (event) {
       event.preventDefault();

        $.ajax({
            url: "post/update-snippet.php",
            data: {snippets_id: this.id, title : this.value},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if(!json.ok) {
                    alert(json.message);
                } else {
                    window.location.reload();
                }
            }
        });
    });

    $("textarea.snip").change(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/update-snip.php",
            data: {id: this.id, text : this.value, class : this.name},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if(!json.ok) {
                    alert(json.message);
                } else {
                    window.location.reload();
                }
            }
        });
    });

    $("button.delete-snip").click(function (event) {
        event.preventDefault();

        if(confirm("Delete Snip?")) {
            $.ajax({
                url: "post/delete-snip.php",
                data: {id: this.id},
                method: "POST",
                success: function (data) {
                    var json = parse_json(data);
                    if (!json.ok) {
                        alert(json.message);
                    } else {
                        window.location.reload();
                    }
                }
            });
        }
    });
};
