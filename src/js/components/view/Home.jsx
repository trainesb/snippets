import React, {Component, Fragment} from 'react';

import Nav from "../container/Nav.jsx";

import Header from "../presentational/Header.jsx";
import Footer from "../presentational/Footer.jsx";

class Home extends Component {

    render() {
        const navLinks = [
            {id: 1, text: "Admin", link: "./admin.php"},
            {id: 2, text: "Profile", link: "./profile.php"},
<<<<<<< HEAD
            {id: 3, text: "Login", link: "./login.php"}
=======
            {id: 3, text: "Logout", link: "post/logout.php"}
>>>>>>> d3e4bda2a4d7a4f07d52a86fa6a31d9acfa4a972
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
