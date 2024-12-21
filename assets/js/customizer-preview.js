/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/customizer-preview.js":
/*!*****************************************!*\
  !*** ./src/admin/customizer-preview.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _styles_admin_customizer_preview_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../styles/admin/customizer-preview.scss */ \"./src/styles/admin/customizer-preview.scss\");\n\n(function ($) {\n  wp.customize.section('trademate_out_of_stock', function (section) {\n    section.expanded.bind(function (isExpanded) {\n      if (isExpanded) {\n        // Replace with the actual Shop page URL dynamically passed from PHP\n        var shopPageUrl = tm_wp_customizer_settings.shopPageUrl;\n\n        // Redirect the Customizer preview to the Shop page\n        if (shopPageUrl) {\n          wp.customize.previewer.previewUrl.set(shopPageUrl);\n        }\n      }\n    });\n  });\n  wp.customize.section('trademate_sales_countdown', function (section) {\n    section.expanded.bind(function (isExpanded) {\n      if (isExpanded) {\n        // Replace with the actual Shop page URL dynamically passed from PHP\n        var shopPageUrl = tm_wp_customizer_settings.shopPageUrl;\n\n        // Redirect the Customizer preview to the Shop page\n        if (shopPageUrl) {\n          wp.customize.previewer.previewUrl.set(shopPageUrl);\n        }\n      }\n    });\n  });\n  $(document).ready(function () {\n    // Initialize range sliders\n    $('input[type=\"range\"]').each(function () {\n      var $slider = $(this);\n      var min = $slider.attr('min') || 10;\n      var max = $slider.attr('max') || 50;\n\n      // Create tooltip element\n      var $tooltip = $('<div class=\"range-slider-tooltip\"></div>');\n      $tooltip.text($slider.val()); // Set initial value\n      $slider.after($tooltip);\n\n      // Function to update tooltip position and value\n      function updateTooltip() {\n        var value = $slider.val();\n        var percentage = (value - min) / (max - min) * 100;\n\n        // Update tooltip position and text\n        $tooltip.css({\n          left: \"calc(\".concat(percentage, \"% + (\").concat(20 - percentage * 0.4, \"px))\") // Dynamic adjustment\n        });\n        $tooltip.text(value);\n      }\n\n      // Bind input and change events\n      $slider.on('input change', function () {\n        updateTooltip();\n      });\n\n      // Initialize tooltip on page load\n      updateTooltip();\n    });\n  });\n})(jQuery);\n\n//# sourceURL=webpack://trademate/./src/admin/customizer-preview.js?");

/***/ }),

/***/ "./src/styles/admin/customizer-preview.scss":
/*!**************************************************!*\
  !*** ./src/styles/admin/customizer-preview.scss ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://trademate/./src/styles/admin/customizer-preview.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/admin/customizer-preview.js");
/******/ 	
/******/ })()
;