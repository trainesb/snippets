import $ from 'jquery';

import {Login} from "./Login";
import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import '../scss/app.scss';

$(document).ready(function () {
    new Login();
    new Doc();
    new Admin();
    new Topic();
    new Home();
});
