import React from 'react';
import { InputNumber } from 'primereact/inputnumber';

const Number = ({ label, description, inputValue, setInputValue }) => {
    return (
        <div className="flex align-items-center justify-content-between gap-2">
            <div className="label-wrapper flex flex-column flex-wrap">
                <label htmlFor="switch" className="mb-2"> {label} </label>
                <p className="text-sm text-400"> { description } </p>
            </div>
            <InputNumber 
                inputId="horizontal-buttons" 
                value={inputValue} 
                onValueChange={(e) => setInputValue(e.value)} 
                showButtons 
                buttonLayout="horizontal" 
                step={1}
                decrementButtonClassName="p-button-secondary" 
                incrementButtonClassName="p-button-primary" 
                incrementButtonIcon="pi pi-plus" 
                decrementButtonIcon="pi pi-minus"
            />
        </div>
    );
}

export default Number;