import React, { useState, useEffect } from 'react';

import "primereact/resources/themes/lara-light-cyan/theme.css";
import 'primereact/resources/primereact.min.css'; 
import 'primeflex/primeflex.css';
import 'primeicons/primeicons.css';

import MenuBar from '../layout/MenuBar';
import Content from '../layout/Content';

// Utility function to retrieve the last active menu item from localStorage
const getInitialActiveMenuItem = (settingsSections) => {
    const savedMenuItem = localStorage.getItem('trademateActiveMenuItem');
    return savedMenuItem || (settingsSections.length > 0 ? settingsSections[0].id : null);
};

const Settings = () => {
    const { settings_sections: settingsSections, settings_fields: settingsFields } = trademate_settings;

    const [activeMenuItem, setActiveMenuItem] = useState(() => getInitialActiveMenuItem(settingsSections));

    // Save the activeMenuItem to localStorage whenever it changes
    useEffect(() => {
        if (activeMenuItem) {
            localStorage.setItem('trademateActiveMenuItem', activeMenuItem);
        }
    }, [activeMenuItem]);

    return (
        <div className="grid md:w-10 m-auto settings-wrapper">
            <div className="md:col-2 settings-menu">
                <MenuBar sections={settingsSections} activeMenuItem={activeMenuItem} setActiveMenuItem={setActiveMenuItem} />
            </div>
            <div className="md:col-10 settings-container">
                <Content sections={settingsSections} fields={settingsFields} activeMenuItem={activeMenuItem} />
            </div>
        </div>
    );
};

export default Settings;