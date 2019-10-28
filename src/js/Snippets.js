import $ from 'jquery';
import {parse_json} from './parse_json';

export const Snippet = function() {

    $("button.add-textarea").click(function (event) {
        event.preventDefault();

        $("div.container").append('<div class="new description" contenteditable="true"><p></p></div>');
    });

    $("button.add-code").click(function (event) {
        event.preventDefault();

        $("div.container").append('<div class="new code"><pre><code contenteditable="true"></code></pre></div>')
    });

    $("p.done-edit > a").click(function (event) {
       event.preventDefault();

       var title = $("h1.snippet-title").text();
       var data = [];

       var i = 0;
       $("div.container").children().each(function () {
           if(i !== 0) {
               if($(this).hasClass('new')) {

                   if ($(this).hasClass('description')) {
                       var text = $(this).text();
                       data.push({snip_id: null, text: text});
                   } else if ($(this).hasClass('code')) {
                       var code = $(this).text();
                       data.push({snip_id: null, code: code});
                   }
               } else {

                   if ($(this).hasClass('description')) {
                       var text = $(this).text();
                       var snip_id = this.firstChild.id;
                       data.push({snip_id: snip_id, text: text});
                   } else if ($(this).hasClass('code')) {
                       var code = $(this).text();
                       var snip_id = $(this).children()[0].id;
                       data.push({snip_id: snip_id, code: code});
                   }
               }
           }
           i++;

       });

       var url = new URL(window.location.href);
       var snippet_id = url.searchParams.get('id');
       var lang_id = url.searchParams.get('lang_id');




        $.ajax({
            url: "post/snippet.php",
            data: {title: title, snippet_id: snippet_id, data: data},
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(!json.ok) {
                    alert(json.message);
                } else {
                    window.location.assign('./snippet.php?lang_id='+lang_id+'&id='+snippet_id+'&mode=view');
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });

    $("button.delSnip").click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "post/delete-snip.php",
            data: {id: this.id},
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
};
