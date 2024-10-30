import React, { useState } from 'react';
import { __ } from '@wordpress/i18n';

const MenuBar = ({ sections, activeMenuItem, setActiveMenuItem }) => {
    const [menuOpen, setMenuOpen] = useState(false);

    return (
        <nav className={`custom-menu ${menuOpen ? 'open' : ''}`}>
            <button className="menu-toggle" onClick={() => setMenuOpen(!menuOpen)}>
                <i className='pi pi-bars'/> 
                <span>{ __( 'Menu', 'trademate' ) }</span>
            </button>
            <ul className="menu-list">
                {/* Close Button */}
                <button className="close-button" onClick={() => setMenuOpen(false)}>
                    ✕
                </button>

                {sections.map((section) => (
                    <li
                        key={section.id}
                        className={`menu-item ${section.id === activeMenuItem ? 'active-menu-item' : ''}`}
                        onClick={() => {
                            setActiveMenuItem(section.id);
                            setMenuOpen(false); // Close menu on item click
                        }}
                    >
                        <i className={`pi ${section.icon}`} />
                        <span>{section.title}</span>
                    </li>
                ))}
            </ul>
        </nav>
    );
}

export default MenuBar;