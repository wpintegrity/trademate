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

/***/ "./src/frontend/quantity-handler.js":
/*!******************************************!*\
  !*** ./src/frontend/quantity-handler.js ***!
  \******************************************/
/***/ (() => {

eval("jQuery(document).ready(function ($) {\n  $('.single-product .quantity').on('click', '.tm-qty-plus', function () {\n    var input = $(this).siblings('.qty');\n    var max = parseFloat(input.attr('max')) || Infinity;\n    var step = parseFloat(input.attr('step')) || 1;\n    var currentValue = parseFloat(input.val()) || 0;\n    if (currentValue + step <= max) {\n      input.val(currentValue + step).trigger('change');\n    }\n  });\n  $('.single-product .quantity').on('click', '.tm-qty-minus', function () {\n    var input = $(this).siblings('.qty');\n    var min = parseFloat(input.attr('min')) || 0;\n    var step = parseFloat(input.attr('step')) || 1;\n    var currentValue = parseFloat(input.val()) || 0;\n    if (currentValue - step >= min) {\n      input.val(currentValue - step).trigger('change');\n    }\n  });\n});\n\n//# sourceURL=webpack://trademate/./src/frontend/quantity-handler.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/frontend/quantity-handler.js"]();
/******/ 	
/******/ })()
;