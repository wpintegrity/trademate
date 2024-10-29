/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/frontend/clear-cart.js":
/*!************************************!*\
  !*** ./src/frontend/clear-cart.js ***!
  \************************************/
/***/ (() => {

eval("jQuery(document).ready(function ($) {\n  $('.clear-cart-button').on('click', function (e) {\n    e.preventDefault();\n    $.ajax({\n      url: tm_clear_cart.ajax_url,\n      type: 'POST',\n      data: {\n        action: 'clear_cart',\n        nonce: tm_clear_cart.nonce\n      },\n      success: function success(response) {\n        if (response.success) {\n          location.reload();\n        } else {\n          alert(response.data);\n        }\n      },\n      error: function error() {\n        alert('Error clearing cart.');\n      }\n    });\n  });\n});\n\n//# sourceURL=webpack://trademate/./src/frontend/clear-cart.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/frontend/clear-cart.js"]();
/******/ 	
/******/ })()
;