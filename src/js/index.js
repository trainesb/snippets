import $ from 'jquery';

import {Login} from "./Login";
import {AddLanguage} from "./AddLanguage";
import {AddSnippet} from "./AddSnippet";

import '../scss/app.scss';

$(document).ready(function () {
    new Login();
    new AddLanguage();
    new AddSnippet();
});
