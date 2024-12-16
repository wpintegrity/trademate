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

/***/ "./src/admin/customizer-preview.js":
/*!*****************************************!*\
  !*** ./src/admin/customizer-preview.js ***!
  \*****************************************/
/***/ (() => {

eval("(function ($) {\n  wp.customize.section('trademate_out_of_stock', function (section) {\n    section.expanded.bind(function (isExpanded) {\n      if (isExpanded) {\n        // Replace with the actual Shop page URL dynamically passed from PHP\n        var shopPageUrl = tm_wp_customizer_settings.shopPageUrl;\n\n        // Redirect the Customizer preview to the Shop page\n        if (shopPageUrl) {\n          wp.customize.previewer.previewUrl.set(shopPageUrl);\n        }\n      }\n    });\n  });\n})(jQuery);\n\n//# sourceURL=webpack://trademate/./src/admin/customizer-preview.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/admin/customizer-preview.js"]();
/******/ 	
/******/ })()
;