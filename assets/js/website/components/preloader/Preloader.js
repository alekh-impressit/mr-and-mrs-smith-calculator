import React from "react";
import "./Preloader.scss";
import PreloaderImage from "./../../../../images/preloader.svg";

class Preloader extends React.Component {
    render()
    {
        const {active} = this.props;

        let response = '';

        if (active) {
            response = <div className="c-preloader">
                <img src={PreloaderImage} className="c-preloader__icon" alt="preloader" />
            </div>;
        }

        return response;

    }
}

export default Preloader;
