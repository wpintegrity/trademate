import React, { useEffect } from 'react';  
import { Menu } from 'primereact/menu';  

const MenuBar = ( { sections, activeMenuItem, setActiveMenuItem } ) => {
    const dynamicMenuItems = sections.map((section) => {
        return {
            label: section.title,
            icon: 'pi ' + section.icon,
            className: section.id === activeMenuItem ? 'active-menu-item' : '',
            command: () => setActiveMenuItem( section.id )
        }
    });
    
    const menuItems = [ ...dynamicMenuItems ];

    return (
        <Menu model={menuItems} className='w-full layout-menu'/>
    );
}

export default MenuBar;