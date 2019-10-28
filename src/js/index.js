import $ from 'jquery';

import {Login} from "./Login";
import {AddLanguage} from "./AddLanguage";
import {Snippet} from "./Snippets";
import {Home} from "./Home";

import '../scss/app.scss';

$(document).ready(function () {
    new Login();
    new Home();
    new Snippet();
    new AddLanguage();
});
