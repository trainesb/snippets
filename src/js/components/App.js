import React, {Component} from "react";

import Login from "./view/Login.jsx";
import Home from "./view/Home.jsx";

class App extends Component {
    constructor(props) {
        super(props);

        this.state = {
            login: false,
            view: 'login'
        };

        this.changeView = this.changeView.bind(this);
        this.setLogin = this.setLogin.bind(this);
    }

    changeView (view) {
        this.setState({view : view})
    }

    setLogin (bool) {
        this.setState({login: bool});
    }


    render() {

        if(this.state.view === 'login') {
            return(<Login setLogin={this.setLogin} changeView={this.changeView}/>)
        }
        if(this.state.view === 'home') {
            return(<Home />)
        }
    }
}

export default App;
