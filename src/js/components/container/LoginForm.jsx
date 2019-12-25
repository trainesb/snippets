import React, { Component } from "react";

import Input from "../presentational/Input.jsx";
import Link from "../presentational/Link.jsx";

class LoginForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            email: "",
            password: "",
            error: null
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState({ [event.target.id]: event.target.value });
    }

    handleFormSubmit( event ) {
        event.preventDefault();


        fetch('post/login.php', {
                method: 'POST',
                headers: {'content-type': 'application/json'},
                body: JSON.stringify(this.state),
            })
            .then((response) => response.json())
            .then((responseJson) => {

                if(responseJson.ok) {
                    console.log(responseJson);
                    this.props.setLogin(true);
                    this.props.setView('home');
                    //window.location = '/snippets/';
                } else {
                    alert("Invalid LoginForm");
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }

    render() {
        const { email, password } = this.state;
        return (
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
                    <p><Link link="" text="Lost Password" /></p>
                    <p><Link link="" text="Register" /></p>
                </fieldset>
            </form>
        );
    }
}
export default LoginForm;
