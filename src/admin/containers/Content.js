import React, { useState, useRef } from 'react';
import { Panel } from 'primereact/panel';
import { Button } from 'primereact/button';
import { ProgressSpinner } from 'primereact/progressspinner';
import { Toast } from 'primereact/toast';
import { __ } from '@wordpress/i18n';

import Switcher from '../components/Switcher';
import Number from '../components/Number';
import SelectBtn from '../components/SelectBtn';
import DropdownSelector from '../components/DropdownSelector';

import { useSettingsFetch } from '../hooks/useSettingsFetch';
import { useSettingsSubmit } from '../hooks/useSettingsSubmit';
import { 
    initializeSwitchValues, 
    initializeInputValues, 
    initializeSelectValues,
    initializeDropdownValues
} from '../utils/initializeSettings';
import { 
    handleSwitchChange, 
    handleNumberChange, 
    handleSelectChange,
    handleDropdownChange
} from '../utils/inputHandlers';

const Content = ({ sections, fields, activeMenuItem }) => {
    const toast = useRef(null); // Create a reference for Toast

    // Find the active section and fields data
    const activeSection = sections.find(section => section.id === activeMenuItem);
    const panelHeader = activeSection ? activeSection.title : '';
    const fieldsData = fields[activeMenuItem] || {};

    // State for holding the values of switches, numbers, selects, and dropdown combinations
    const [switchValues, setSwitchValues] = useState({});
    const [inputValues, setInputValues] = useState({});
    const [selectValues, setSelectValues] = useState({});
    const [dropdownValues, setDropdownValues] = useState({});

    // Initialize settings state
    const initializeSettings = (settings) => {
        const activeSectionSettings = settings || {};
        setSwitchValues(initializeSwitchValues(fieldsData, activeSectionSettings));
        setInputValues(initializeInputValues(fieldsData, activeSectionSettings));
        setSelectValues(initializeSelectValues(fieldsData, activeSectionSettings));
        setDropdownValues(initializeDropdownValues(fieldsData, activeSectionSettings));
    };

    // Fetch settings with custom hook
    const loading = useSettingsFetch(activeMenuItem, initializeSettings);

    // Handle settings submission with custom hook
    const handleSubmit = useSettingsSubmit(toast);

    // Render individual field components based on type
    const renderField = (key, field) => {
        switch (field.type) {
            case 'switch':
                return (
                    <Switcher
                        label={field.label}
                        description={field.description}
                        switchValue={switchValues[key]}
                        setSwitchValue={(newValue) => handleSwitchChange(key, newValue, setSwitchValues)}
                    />
                );
            case 'number':
                return (
                    <Number
                        label={field.label}
                        description={field.description}
                        inputValue={inputValues[key]}
                        setInputValue={(newValue) => handleNumberChange(key, newValue, setInputValues)}
                    />
                );
            case 'select':
                return (
                    <SelectBtn
                        label={field.label}
                        description={field.description}
                        selectOptions={field.options}
                        value={selectValues[key]}
                        setValue={(newValue) => handleSelectChange(key, newValue, setSelectValues)}
                    />
                );
            case 'dropdown':
                return (
                    <DropdownSelector
                        label={field.label}
                        description={field.description}
                        options={field.options}
                        selectedValue={dropdownValues[key]}
                        setSelectedValue={(newValue) => handleDropdownChange(key, newValue, setDropdownValues)}
                    />
                );
                
            default:
                return null; // Unhandled field type
        }
    };

    return (
        <Panel header={panelHeader}>
            {loading ? (
                <div className="flex justify-content-center align-items-center">
                    <ProgressSpinner />
                </div>
            ) : (
                <>
                    {/* Toast Component for showing notifications */}
                    <Toast ref={toast} position="bottom-right" />

                    {Object.entries(fieldsData).map(([key, field]) => (
                        <div key={key} className="field-wrapper">
                            {renderField(key, field)}
                        </div>
                    ))}

                    <div className="flex justify-content-end">
                        <Button 
                            label={ __( 'Submit', 'trademate' ) } 
                            onClick={() => handleSubmit(activeMenuItem, switchValues, inputValues, selectValues, dropdownValues)} 
                        />
                    </div>
                </>
            )}
        </Panel>
    );
};

export default Content;