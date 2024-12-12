import React from 'react';
import { Dropdown } from 'primereact/dropdown';

const DropdownSelector = ({ label, description, options = {}, selectedValue, setSelectedValue }) => {
    const dropdownOptions = Object.entries(options).map(([key, value]) => ({
        label: value,
        value: key,
    }));

    return (
        <div className="flex align-items-center justify-content-between gap-2">
            <div className="label-wrapper flex flex-column flex-wrap">
                <label htmlFor="dropdown" className="mb-2">{label}</label>
                <p className="text-sm text-400">{description}</p>
            </div>
            <div className="dropdown-wrapper">
                <Dropdown
                    id="dropdown"
                    value={selectedValue} // Bind to the current value
                    options={dropdownOptions} // Transformed options
                    onChange={(e) => setSelectedValue(e.value)} // Update state on change
                    placeholder="Select an option"
                />
            </div>
        </div>
    );
};

export default DropdownSelector;