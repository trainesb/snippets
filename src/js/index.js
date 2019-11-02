import $ from 'jquery';

import Form from './components/container/Form.jsx';

import {Login} from "./Login";
import {Home} from "./Home";
import {Admin} from "./Admin";
import {Topic} from "./Topic";
import {Doc} from "./Doc";

import '../scss/app.scss';
import ReactDOM from "react-dom";
import React, { Component } from "react";

$(document).ready(function () {
    ReactDOM.render(<Form />, document.getElementById("react-test"));
    new Login();
    new Doc();
    new Admin();
    new Topic();
    new Home();
});
