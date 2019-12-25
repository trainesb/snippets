import React, {Component, Fragment} from 'react';

import Nav from "../container/Nav.jsx";

import Header from "../presentational/Header.jsx";
import Footer from "../presentational/Footer.jsx";

class Home extends Component {

    render() {
        const navLinks = [
            {id: 1, text: "Admin", link: "./admin.php"},
            {id: 2, text: "Profile", link: "./profile.php"},
            {id: 3, text: "Login", link: "./login.php"}
        ];

        return(
            <Fragment>
                <Nav navLinks={navLinks}/>
                <Header title="Home" />
                <Footer/>
            </Fragment>
        );
    }
}

export default Home;
