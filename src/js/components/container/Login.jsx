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

        var self = this;

        fetch('post/login.php', {
                method: 'POST',
                headers: {'content-type': 'application/json'},
                body: JSON.stringify(self.state),
            })
            .then((response) => response.json())
            .then((responseJson) => {

                console.log(responseJson);

                if(responseJson.ok) {
                    window.location.assign('./');
                } else {
                    alert("Invalid Login");
                }
            })
            .catch((error) => {
                console.error(error);
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
