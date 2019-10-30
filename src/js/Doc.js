import $ from 'jquery';
import {parse_json} from './parse_json';

export const Doc = function() {

    $("button.add-section").click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/add-section.php",
            data: {doc_id: this.value, tag : this.name, text: ''},
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

    $("h1.snippet-title").on('input', function(event) {
        event.preventDefault();

        $.ajax({
            url: "post/update-doc.php",
            data: {topic_id: this.id, title: this.innerText},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if (!json.ok) {
                    alert(json.message);
                }
            }
        });

    });

    $(".section").on('input', function (event) {
        event.preventDefault();

        var type = 'text';
        if($(this).hasClass('code')) {
            type = 'code';
        }

        $.ajax({
            url: "post/update-section.php",
            data: {id: this.id, text : this.innerText, class : type},
            method: "POST",
            success: function (data) {
                var json = parse_json(data);
                if(!json.ok) {
                    alert(json.message);
                }
            }
        });
    });

    $("button.delete-section").click(function (event) {
        event.preventDefault();

        if(confirm("Delete Section?")) {
            $.ajax({
                url: "post/delete-section.php",
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
