import React from 'react';
import { InputText } from 'primereact/inputtext';

const TextInput = ({ label, description, inputValue, setInputValue }) => {
    return (
        <div className="flex align-items-center justify-content-between gap-2">
            <div className="label-wrapper flex flex-column flex-wrap">
                <label htmlFor="textInput" className="mb-2">{label}</label>
                <p className="text-sm text-400">{description}</p>
            </div>
            <div className="input-wrapper">
                <InputText 
                    id="textInput" 
                    value={inputValue} 
                    onChange={(e) => setInputValue(e.target.value)} 
                    className="w-full" 
                    placeholder="Add to Cart"
                />
            </div>
        </div>
    );
};

export default TextInput;