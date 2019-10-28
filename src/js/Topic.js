import $ from 'jquery';
import {parse_json} from './parse_json';

export const Topic = function() {

    $("button.create-doc").click(function (event) {
        event.preventDefault();

        var topic_id = this.name;
        var topic = this.value;

        $.ajax({
            url: "post/add-doc.php",
            data: {topic_id : topic_id},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    window.location.assign('./doc.php?topic='+topic+'&id='+json.doc_id+"&mode=edit");
                } else {
                    alert(json.message);
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });

    $("button.delete-doc").click(function (event) {
        event.preventDefault();

        if(confirm("Do you want to delete "+this.name+"?")) {
            $.ajax({
                url: "post/delete-doc.php",
                data: {doc_id: this.id},
                method: "POST",
                success: function (data) {
                    var json = parse_json(data);
                    if (json.ok) {
                        window.location.reload();
                    } else {
                        alert(json.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("Error: " + error);
                }
            });
        }
    });
};
