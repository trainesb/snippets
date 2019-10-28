import $ from 'jquery';
import {parse_json} from './parse_json';

export const Home = function() {

    $("button.delete-snippet").click(function (event) {
        event.preventDefault();

        var title = this.name;
        var id = this.id;
        if(confirm("Delete "+title+"?")) {

            $.ajax({
                url: "post/delete-snippet.php",
                data: {id : id},
                method: "POST",
                success: function(data) {
                    var json = parse_json(data);
                    if(json.ok) {
                        window.location.reload();
                        //window.location.assign('./snippet.php?lang_id='+json.lang_id+'&id='+json.snip_id+"&mode=edit");
                    } else {
                        alert(json.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error);
                }
            });

        }
    });

    $("button.create-snippet").click(function (event) {
        event.preventDefault();

        var lang_id = this.name;

        $.ajax({
            url: "post/add-snippet.php",
            data: {lang_id : lang_id},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    window.location.assign('./snippet.php?lang_id='+lang_id+'&id='+json.id+"&mode=edit");
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
