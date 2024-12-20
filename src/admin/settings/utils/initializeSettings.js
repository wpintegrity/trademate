// Generalized utility to initialize values based on field type
const initializeValues = (fieldsData, activeSectionSettings, fieldType, defaultFallback) => {
    const initialState = {};
    Object.entries(fieldsData).forEach(([key, field]) => {
        if (field.type === fieldType) {
            initialState[key] = activeSectionSettings[key] !== undefined
                ? activeSectionSettings[key]
                : field.default || defaultFallback; // Fallback to default or a provided value
        }
    });
    return initialState;
};

// Initialize switch values
export const initializeSwitchValues = (fieldsData, activeSectionSettings) => {
    return initializeValues(fieldsData, activeSectionSettings, 'switch', false);
};

// Initialize input values
export const initializeInputValues = (fieldsData, activeSectionSettings) => {
    return initializeValues(fieldsData, activeSectionSettings, 'number', 0);
};

// Initialize select values
export const initializeSelectValues = (fieldsData, activeSectionSettings) => {
    return initializeValues(fieldsData, activeSectionSettings, 'select', '');
};

// Initialize dropdown values
export const initializeDropdownValues = (fieldsData, activeSectionSettings) => {
    return initializeValues(fieldsData, activeSectionSettings, 'dropdown', null);
};

// Initialize text values
export const initializeTextValues = (fieldsData, activeSectionSettings) => {
    return initializeValues(fieldsData, activeSectionSettings, 'text', '');
};