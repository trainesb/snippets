import React, { Component, Fragment } from "react";
import $ from "jquery";
import {parse_json} from "../../parse_json";

import Input from "../presentational/Input.jsx";
import Link from "../presentational/Link.jsx";
import Footer from "../presentational/Footer.jsx";

class Login extends Component {
    constructor(props) {
        super(props);

        this.state = {
            email: "",
            password: "",
            error: null,
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState({ [event.target.id]: event.target.value });

        console.log(this.state);
    }

    handleFormSubmit( event ) {
        event.preventDefault();

        console.log(this.state);
        var state = this;

        $.ajax({
            url: "post/login.php",
            data: this.state,
            method: "POST",
            success: function(data) {
                var json = parse_json(data);
                if(json.ok) {
                    if(json.staff) {
                        window.location.assign("./author.php");
                    } else {
                        window.location.assign('./');
                    }
                } else {
                    state.setState({ error: json.message});
                    alert(state.state.error);
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }

    render() {
        const { email, password } = this.state;
        return (
            <Fragment>
                <form id="login-form">
                    <fieldset>
                        <legend>Login</legend>
                        <Input
                            text="Email"
                            label="email"
                            type="email"
                            id="email"
                            value={email}
                            handleChange={this.handleChange}
                            required
                        />
                        <Input
                            text="Password"
                            label="password"
                            type="password"
                            id="password"
                            value={password}
                            handleChange={this.handleChange}
                            required
                        />
                        <Input
                            text="Stay Logged In?"
                            label="cookie"
                            type="checkbox"
                            id="cookie"
                            value="false"
                            handleChange={this.handleChange}
                        />
                        <button onClick={e => this.handleFormSubmit(e)}>Submit</button>
                        <Link link="" text="Lost Password" />
                        <Link link="" text="Register" />
                    </fieldset>
                </form>
                <Footer companyName="BT" />
            </Fragment>
        );
    }
}
export default Login;
