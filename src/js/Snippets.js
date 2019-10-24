import $ from 'jquery';
import {parse_json} from './parse_json';

export const Snippet = function() {

    $("button.add-textarea").click(function (event) {
        event.preventDefault();

        $("div.container").append('<div class="description" contenteditable="true"><p></p></div>');
    });

    $("button.add-code").click(function (event) {
        event.preventDefault();

        $("div.container").append('<div class="code"><pre><code contenteditable="true"></code></pre></div>')
    });
};
