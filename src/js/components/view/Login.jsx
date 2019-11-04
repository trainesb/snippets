import React, {Component, Fragment} from "react";

import Nav from "../container/Nav.jsx";
import LoginForm from "../container/LoginForm.jsx";
import Header from "../presentational/Header.jsx";
import Footer from "../presentational/Footer.jsx";


class Login extends Component {

    constructor(props) {
        super(props);

        this.setLogin = this.setLogin.bind(this);
    }

    setLogin(bool) {
        this.props.setLogin(bool);
    }

    render() {
        const navLinks = [
            {id: 1, text: "Admin", link: "./admin.php"},
            {id: 2, text: "Profile", link: "./profile.php"}
        ];

        return (
            <Fragment>
                <Nav navLinks={navLinks} />
                <Header title="Login"/>
                <LoginForm setLogin={this.setLogin}  changeView={this.props.changeView}/>
                <Footer />
            </Fragment>
        );
    }
}

export default Login;
