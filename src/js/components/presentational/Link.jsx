import React from "react";
import PropTypes from "prop-types";

const Link = ({ link, text }) => (
    <p className="link-group">
        <a className="link-control" href={link}>{text}</a>
    </p>
);

Link.propTypes = {
    link: PropTypes.string.isRequired,
    text: PropTypes.string.isRequired
};

export default Link;
