import React from 'react';
import ReactDOM from 'react-dom/client';
import TradeMateAdmin from './App';

import '../../styles/admin/admin.scss';

const rootElement = document.getElementById('trademate-admin');
const trademateAdminRoot = ReactDOM.createRoot( rootElement );

trademateAdminRoot.render(
  <React.StrictMode>
    <TradeMateAdmin/>
  </React.StrictMode>
);
