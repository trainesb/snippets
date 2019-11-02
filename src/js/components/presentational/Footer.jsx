import React from "react";
import PropTypes from "prop-types";

const Footer = ({ companyName }) => (
  <footer>
      <p>Copyright © 2019 {companyName}. All Rights Reserved.</p>
  </footer>
);

Footer.prototype = {
    companyName: PropTypes.string.isRequired
};

export default Footer;
