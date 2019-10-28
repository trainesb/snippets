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

    $("input.title").change(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/update-doc.php",
            data: {topic_id: this.id, title : this.value},
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

    $("textarea.section").change(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/update-section.php",
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
