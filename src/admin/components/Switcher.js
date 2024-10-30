import React from 'react';
import { InputSwitch } from 'primereact/inputswitch';

const Switcher = ({ label, description, switchValue, setSwitchValue }) => {
    return (
        <div className="flex align-items-center justify-content-between gap-2">
            <div className="label-wrapper flex flex-column flex-wrap">
                <label htmlFor="switch" className="mb-2"> {label} </label>
                <p className="text-sm text-400"> { description } </p>
            </div>
            <div className="input-wrapper">
                <InputSwitch 
                    id='switch' 
                    checked={switchValue} 
                    onChange={(e) => setSwitchValue(e.value)} 
                />
            </div>
        </div>
    );
}

export default Switcher;