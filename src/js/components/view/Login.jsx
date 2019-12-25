import React, {Component, Fragment} from "react";

import Nav from "../container/Nav.jsx";
import LoginForm from "../container/LoginForm.jsx";
import Header from "../presentational/Header.jsx";
import Footer from "../presentational/Footer.jsx";
import Link from "../presentational/Link.jsx";


class Login extends Component {

    renderLogin(navLinks) {
        return (
            <Fragment>
                <Nav navLinks={navLinks} />
                <Header title="Login"/>
                <LoginForm />
                <Footer />
            </Fragment>
        );
    }

    renderLogout(navLinks) {
        return (
            <Fragment>
                <Nav navLinks={navLinks} />
                <Header title="Logout"/>
                <p><Link text='Logout' link='./post/logout.php'/></p>
                <Footer />
            </Fragment>
        );
    }

    render() {
        const navLinks = [
            {id: 1, text: "Admin", link: "./admin.php"},
            {id: 2, text: "Profile", link: "./profile.php"}
        ];

        if(!this.props.login) {
            return(this.renderLogin(navLinks));
        } else {
            return(this.renderLogout(navLinks));
        }
    }
}

export default Login;
