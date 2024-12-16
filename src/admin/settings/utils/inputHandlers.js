/**
 * Generalized handler for updating state values.
 *
 * @param {string} key - The key corresponding to the field being updated.
 * @param {*} newValue - The new value for the field.
 * @param {Function} setState - The setState function for updating the relevant state.
 */
const handleChange = (key, newValue, setState) => {
    setState(prevState => ({
        ...prevState,
        [key]: newValue, // Update the specific value based on its key
    }));
};

// Export specialized handlers using the generalized handleChange function

export const handleSwitchChange = (key, newValue, setSwitchValues) => {
    handleChange(key, newValue, setSwitchValues);
};

export const handleNumberChange = (key, newValue, setInputValues) => {
    handleChange(key, newValue, setInputValues);
};

export const handleSelectChange = (key, newValue, setSelectValues) => {
    handleChange(key, newValue, setSelectValues);
};

export const handleDropdownChange = (key, newValue, setDropdownValues) => {
    handleChange(key, newValue, setDropdownValues);
};

export const handleTextChange = (key, newValue, setTextValues) => {
    handleChange(key, newValue, setTextValues);
};