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

/***/ "./src/frontend/sale-countdown-timer.js":
/*!**********************************************!*\
  !*** ./src/frontend/sale-countdown-timer.js ***!
  \**********************************************/
/***/ (() => {

eval("jQuery(document).ready(function ($) {\n  $('.sale-countdown-timer').each(function () {\n    var timerElement = $(this);\n    var saleEndTimestamp = parseInt(timerElement.data('sale-end'), 10);\n    if (saleEndTimestamp) {\n      var saleEndDate = new Date(saleEndTimestamp * 1000); // Convert to milliseconds\n\n      var updateCountdown = function updateCountdown() {\n        var now = new Date();\n        var timeLeft = saleEndDate - now;\n        if (timeLeft > 0) {\n          var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));\n          var hours = Math.floor(timeLeft % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));\n          var minutes = Math.floor(timeLeft % (1000 * 60 * 60) / (1000 * 60));\n          var seconds = Math.floor(timeLeft % (1000 * 60) / 1000);\n          timerElement.html(\"\\n                        <div class=\\\"timer\\\">\\n                            <span class=\\\"days\\\">\".concat(days, \"d</span>\\n                            <span class=\\\"hours\\\">\").concat(hours, \"h</span>\\n                            <span class=\\\"minutes\\\">\").concat(minutes, \"m</span>\\n                            <span class=\\\"seconds\\\">\").concat(seconds, \"s</span>\\n                        </div>\\n                    \"));\n        } else {\n          timerElement.html('<span class=\"expired\">Sale Ended!</span>');\n        }\n      };\n\n      // Initial call and update every second\n      updateCountdown();\n      setInterval(updateCountdown, 1000);\n    }\n  });\n});\n\n//# sourceURL=webpack://trademate/./src/frontend/sale-countdown-timer.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/frontend/sale-countdown-timer.js"]();
/******/ 	
/******/ })()
;