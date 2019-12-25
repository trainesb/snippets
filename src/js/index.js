import $ from 'jquery';
import React from "react";
import ReactDOM from "react-dom";

import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import '../scss/app.scss';
import Home from "./components/view/Home.jsx";
import Login from "./components/view/Login.jsx"


$(document).ready(function () {


    const target = document.getElementById('home');
    target ? ReactDOM.render(<Home />, target) : false;

    const login = document.getElementById('login');
    login ? ReactDOM.render(<Login />, login) : false;

    new Doc();
    new Admin();
    new Topic();
});