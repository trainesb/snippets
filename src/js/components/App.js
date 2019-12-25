import React, {Component} from "react";

import Login from "./view/Login.jsx";
import Home from "./view/Home.jsx";
import Profile from "./view/Profile.jsx";

class App extends Component {
    constructor(props) {
        super(props);

        this.state = {
            login: false,
            view: 'login'
        };

        this.setView = this.setView.bind(this);
        this.setLogin = this.setLogin.bind(this);
    }

    setView (view) {
        this.setState({view : view})
    }

    setLogin (bool) {
        this.setState({login: bool});
    }


    render() {

        if(this.state.view === 'login') {
            return(<Login login={this.props.login} setLogin={this.setLogin} setView={this.setView}/>)
        }
        else if(this.state.view === 'home') {
            return(<Home setView={this.setView}/>)
        }
        else if(this.state.view === 'profile') {
            return(<Profile />)
        }
    }
}

export default App;
