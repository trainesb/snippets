import $ from 'jquery';
import React from "react";
import ReactDOM from "react-dom";

//import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import '../scss/app.scss';
import App from "./components/App";


$(document).ready(function () {


    const target = document.getElementById('root');
    target ? ReactDOM.render(<App />, target) : false;

    new Doc();
    new Admin();
    new Topic();
    //new Home();
});
