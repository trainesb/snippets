import React, {Component, Fragment} from "react";
import Link from "../presentational/Link.jsx";


function LeftLinks() {
    return(
        <ul className='left'>
            <li><Link text="BT's Black Book" link="./" /></li>
        </ul>
    );
}

function RightLinks(props) {
    const linkList = props.navLinks;
    return (
        <ul className='right'>
            {linkList.map((link) =>
                <li key={link.id} ><Link text={link.text} link={link.link} /></li>
            )}
        </ul>
    );
}

class Nav extends Component {

    constructor(props) {
        super(props);

    }

    render() {

        return (
            <Fragment>
                <nav>
                    <LeftLinks />
                    <RightLinks navLinks={this.props.navLinks} />
                </nav>
            </Fragment>
        );
    }
}

export default Nav;
