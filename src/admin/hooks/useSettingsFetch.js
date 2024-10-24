import { useState, useEffect } from 'react';
import axios from 'axios';

// Utility function for loading from localStorage
const loadFromLocalStorage = (key) => {
    try {
        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    } catch (error) {
        console.error('Error loading from localStorage:', error.message);
        return null;
    }
};

// Utility function for saving to localStorage
const saveToLocalStorage = (key, data) => {
    try {
        localStorage.setItem(key, JSON.stringify(data));
    } catch (error) {
        console.error('Error saving to localStorage:', error.message);
    }
};

export const useSettingsFetch = (activeMenuItem, initializeSettings) => {
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchSettings = async () => {
            const cachedData = loadFromLocalStorage(activeMenuItem);

            if (cachedData) {
                initializeSettings(cachedData);  // Use cached data
                setLoading(false);               // Set loading to false if cache exists
            } else {
                const formData = new FormData();
                formData.append('action', 'get_trademate_settings');
                formData.append('nonce', trademate_settings.nonce);

                try {
                    const { data } = await axios.post(trademate_settings.ajax_url, formData);

                    if (data?.success && data.data) {
                        const settings = data.data[activeMenuItem] || {};
                        initializeSettings(settings);  // Initialize settings with fetched data
                        saveToLocalStorage(activeMenuItem, settings);  // Save to cache
                    } else {
                        console.warn('Failed to fetch settings:', data?.message || 'Unknown error');
                    }
                } catch (error) {
                    console.error('Error fetching settings:', error.message || error);
                } finally {
                    setLoading(false);  // Ensure loading state is updated in all cases
                }
            }
        };

        fetchSettings();
        // Remove initializeSettings from dependency array to prevent infinite loop
    }, [activeMenuItem]);  // Only trigger useEffect when activeMenuItem changes

    return loading;
};