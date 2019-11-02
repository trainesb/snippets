import $ from 'jquery';
import React from "react";
import ReactDOM from "react-dom";

//import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import '../scss/app.scss';
import Login from "./components/view/Login.jsx";
import Home from "./components/view/Home.jsx";


$(document).ready(function () {


    const target = document.getElementById('login');
    target ? ReactDOM.render(<Login />, target) : false;


    const tar = document.getElementById('home');
    tar ? ReactDOM.render(<Home />, tar) : false;



    new Doc();
    new Admin();
    new Topic();
    //new Home();
});
