import $ from 'jquery';
import React from "react";
import ReactDOM from "react-dom";

import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import Login from "./components/container/Login.jsx";
//import Footer from "./components/presentational/Footer.jsx";



import '../scss/app.scss';


$(document).ready(function () {

    ReactDOM.render(<Login />, document.getElementById('login-react-form'));

    new Doc();
    new Admin();
    new Topic();
    new Home();
});
