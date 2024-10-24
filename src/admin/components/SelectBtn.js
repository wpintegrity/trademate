import React, { useState } from 'react';
import { SelectButton } from 'primereact/selectbutton';

const SelectBtn = ({ label, description, selectOptions, value, setValue }) => {
    return(
        <div className="flex align-items-center justify-content-between gap-2">
            <div className="label-wrapper flex flex-column flex-wrap">
                <label htmlFor="switch" className="mb-2"> {label} </label>
                <p className="text-sm text-400"> { description } </p>
            </div>
            <SelectButton 
                value={value} 
                onChange={(e) => setValue(e.value)} 
                options={selectOptions} 
            />
        </div>
    );
}

export default SelectBtn;