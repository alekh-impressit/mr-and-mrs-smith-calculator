import operations from "./Operations";

export default [
    [
        {text: 'AC', isCommand: true, value: operations.AC},
        {text: 'AND', isCommand: true, value: operations.AND},
        {text: 'OR', isCommand: true, value: operations.OR},
        {text: '+', isCommand: true, value: operations.PLUS}
    ],
    [
        {text: '7', isCommand: false, value: "7"},
        {text: '8', isCommand: false, value: "8"},
        {text: '9', isCommand: false, value: "9"},
        {text: '-', isCommand: true, value: operations.MINUS},
    ],
    [
        {text: '4', isCommand: false, value: "4"},
        {text: '5', isCommand: false, value: "5"},
        {text: '6', isCommand: false, value: "6"},
        {text: '÷', isCommand: true, value: operations.DIVISION},
    ],
    [
        {text: '1', isCommand: false, value: "1"},
        {text: '2', isCommand: false, value: "2"},
        {text: '3', isCommand: false, value: "3"},
        {text: '*', isCommand: true, value: operations.MULTIPLICATION},
    ],
    [
        {text: '0', isCommand: false, value: "0", additionalClass: 'c-calculator__keyboard-col-zero'},
        {text: ',', isCommand: false, value: "."},
        {text: '=', isCommand: true, value: operations.EQUAL}
    ]
]
