import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import settings from './settings';

registerBlockType('trademate/clear-cart-button', {
    ...settings,
    edit: Edit,
    save: Save,
});