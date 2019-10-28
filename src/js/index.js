import $ from 'jquery';

import {Login} from "./Login";
import {AddLanguage} from "./AddLanguage";
import {Snippet} from "./Snippets";
import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";

import '../scss/app.scss';

$(document).ready(function () {
    new Login();
    new Admin();
    new Topic();
    new Home();
    new Snippet();
    new AddLanguage();
});
