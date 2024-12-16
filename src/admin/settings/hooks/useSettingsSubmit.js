import axios from 'axios';

// Utility to update cache after submission
const saveToLocalStorage = (key, data) => {
    try {
        localStorage.setItem(key, JSON.stringify(data));
    } catch (error) {
        console.error('Error saving to localStorage:', error.message);
    }
};

/**
 * Custom hook for submitting settings with toast notifications.
 *
 * @param {Object} toast - The PrimeReact Toast reference for displaying notifications.
 * @returns {Function} handleSubmit - The function to handle the form submission.
 */
export const useSettingsSubmit = (toast) => {
    const handleSubmit = async (
        activeMenuItem, 
        switchValues, 
        inputValues, 
        selectValues, 
        dropdownValues,
        textValues
    ) => {
        const settingsData = {
            ...switchValues,
            ...inputValues,
            ...selectValues,
            ...dropdownValues,
            ...textValues
        };

        const formData = new FormData();
        formData.append('action', 'save_trademate_settings');
        formData.append('nonce', trademate_settings.nonce);
        formData.append('section', activeMenuItem);
        formData.append('settingsData', JSON.stringify(settingsData));

        try {
            const { data } = await axios.post(trademate_settings.ajax_url, formData);

            if (data?.success) {
                // Cache the newly saved settings
                saveToLocalStorage(activeMenuItem, settingsData);

                // Show success message using Toast
                toast.current.show({
                    severity: 'success',
                    summary: 'Success',
                    detail: 'Settings saved successfully!',
                    life: 3000
                });
            } else {
                // Handle errors returned from the server
                const errorMessage = data?.data?.message || 'An unknown error occurred.';
                showToast('error', 'Error', errorMessage, 5000);
            }
        } catch (error) {
            // Log the error and show a toast notification
            console.error('Submission Error:', error);
            showToast('error', 'Error', `Error submitting settings: ${error.message || 'Unknown error occurred'}`, 5000);
        }
    };

    /**
     * Helper function to show toast messages.
     *
     * @param {string} severity - The severity of the toast ('success', 'error', etc.).
     * @param {string} summary - The summary message for the toast.
     * @param {string} detail - The detailed message for the toast.
     * @param {number} life - The duration the toast should be displayed.
     */
    const showToast = (severity, summary, detail, life) => {
        toast.current.show({ severity, summary, detail, life });
    };

    return handleSubmit;
};