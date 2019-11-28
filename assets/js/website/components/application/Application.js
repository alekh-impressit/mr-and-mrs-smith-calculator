import React from 'react';
import config from "react-global-configuration";
import configurations from 'js-yaml-loader!../../configs/config.yml';
import "./Common.scss";
import "./Application.scss";
import axios from "axios/index";
import operations from "./Operations";
import keyboard from "./Keyboards";
import Preloader from "../preloader/Preloader";

class Application extends React.Component {
    inputField = null;

    state = {
        showPreloader: false,
        operation: null,
        fistNumber: null,
        inputNumber: null,
        error: null
    };

    constructor(props)
    {
        super(props);
        config.set(configurations);
    };

    changeNumber = (event) => {
        if (event.target.value.match(/^[0-9\.]*$/)) {
            this.setState({
                inputNumber: event.target.value
            });
        } else {
            event.preventDefault();
        }
    };

    calculate = (execOperation) => {
        const {inputNumber, fistNumber, operation} = this.state;

        switch (execOperation) {
            case operations.AC:
                this.resetCalculator();
                break;

            case operations.EQUAL:
                if (inputNumber && fistNumber && operation) {
                    this.calculateProcess();
                }
                break;

            default:
                if (fistNumber === null) {
                    this.setState({
                        fistNumber: inputNumber === null ? 0 : inputNumber,
                        inputNumber: null,
                        operation: execOperation
                    });
                } else if (inputNumber === null) {
                    this.setState({
                        operation: execOperation
                    });
                } else {
                    this.calculateProcess();
                }
                break;
        }
    };

    calculateProcess = () => {
        const {inputNumber, fistNumber, operation} = this.state;

        if (operation === operations.DIVISION && parseInt(inputNumber) === 0) {
            this.setState({
                error: 'Division by zero is forbidden'
            }, () => {
                setTimeout(() => {
                    this.setState({
                        error: null
                    });
                }, 3500);
            })
        } else {
            this.setState({
                showPreloader: true
            });

            axios.post(this.getApiUrlByOperation(operation), {firstNumber: fistNumber, secondNumber: inputNumber})
                .then(res => {
                    this.showResult(res.data.data.result);
                }).finally(() => {
                    this.setState({
                        showPreloader: false
                    });
                });
        }
    };

    getApiUrlByOperation = (operation) => {
        let url;

        switch (operation) {
            case operations.DIVISION:
                url = '/api/1.0/division';
                break;

            case operations.MINUS:
                url = '/api/1.0/minus';
                break;

            case operations.PLUS:
                url = '/api/1.0/plus';
                break;

            case operations.MULTIPLICATION:
                url = '/api/1.0/multiplication';
                break;

            case operations.AND:
                url = '/api/1.0/bitwise/and';
                break;

            case operations.OR:
                url = '/api/1.0/bitwise/or';
                break;
        }

        return url;
    };

    resetCalculator = () => {
        this.setState({
            operation: null,
            fistNumber: null,
            inputNumber: null
        }, () => {
            this.inputField.value = '';
        })
    };

    showResult = (result) => {
        this.setState({
            operation: null,
            fistNumber: null,
            inputNumber: result
        });
    };

    keyPushHandler = (button) => {
        if (button.isCommand) {
            this.calculate(button.value);
        } else {
            const {inputNumber} = this.state;
            let currentNumber = inputNumber === null ? "" : inputNumber;

            this.setState({
                inputNumber: currentNumber + button.value
            });
        }

        this.inputField.focus();
    };

    render()
    {
        const {inputNumber, fistNumber, showPreloader, error} = this.state;

        return <div className="c-calculator">
            <Preloader active={showPreloader}/>
            <div className="c-calculator__input-container">
                {(fistNumber) && <span className="c-calculator__hidden-number">{fistNumber}</span>}
                {error && <span className="c-calculator__error">{error}</span>}
                <input className="c-calculator__input"
                       type="text"
                       value={inputNumber || "" }
                       name="number"
                       autoFocus={true}
                       ref={(el) => { this.inputField = el; }}
                       onChange={this.changeNumber}/>
            </div>
            <div className="c-calculator__keyboard">
                {keyboard.map((row, index) => {
                    return <div key={index} className="c-calculator__keyboard-row">
                        {row.map((button, index) => {
                            return <div key={index}
                                        className={"c-calculator__keyboard-col " + (button.additionalClass ? button.additionalClass : "")}>
                                <button className="c-calculator__keyboard-button" onClick={() => {this.keyPushHandler(button)}}>
                                    {button.text}
                                </button>
                            </div>
                        })}
                    </div>
                })}
            </div>
        </div>;
    };
}

export default Application;
