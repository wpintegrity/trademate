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

/***/ "./src/blocks/clear-cart-button/edit.js":
/*!**********************************************!*\
  !*** ./src/blocks/clear-cart-button/edit.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ \"@wordpress/components\");\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ \"@wordpress/i18n\");\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ \"@wordpress/element\");\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);\nfunction _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }\nfunction _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(r, a) { if (r) { if (\"string\" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return \"Object\" === t && r.constructor && (t = r.constructor.name), \"Map\" === t || \"Set\" === t ? Array.from(r) : \"Arguments\" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }\nfunction _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }\nfunction _iterableToArrayLimit(r, l) { var t = null == r ? null : \"undefined\" != typeof Symbol && r[Symbol.iterator] || r[\"@@iterator\"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t[\"return\"] && (u = t[\"return\"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }\nfunction _arrayWithHoles(r) { if (Array.isArray(r)) return r; }\n\n\n\n\nvar Edit = function Edit(_ref) {\n  var attributes = _ref.attributes,\n    setAttributes = _ref.setAttributes;\n  var label = attributes.label,\n    width = attributes.width,\n    backgroundColor = attributes.backgroundColor,\n    textColor = attributes.textColor,\n    padding = attributes.padding,\n    paddingTop = attributes.paddingTop,\n    paddingRight = attributes.paddingRight,\n    paddingBottom = attributes.paddingBottom,\n    paddingLeft = attributes.paddingLeft,\n    margin = attributes.margin,\n    marginTop = attributes.marginTop,\n    marginRight = attributes.marginRight,\n    marginBottom = attributes.marginBottom,\n    marginLeft = attributes.marginLeft,\n    fontSize = attributes.fontSize,\n    borderRadius = attributes.borderRadius,\n    borderRadiusTopLeft = attributes.borderRadiusTopLeft,\n    borderRadiusTopRight = attributes.borderRadiusTopRight,\n    borderRadiusBottomRight = attributes.borderRadiusBottomRight,\n    borderRadiusBottomLeft = attributes.borderRadiusBottomLeft;\n  var _useState = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false),\n    _useState2 = _slicedToArray(_useState, 2),\n    individualPadding = _useState2[0],\n    setIndividualPadding = _useState2[1];\n  var _useState3 = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false),\n    _useState4 = _slicedToArray(_useState3, 2),\n    individualMargin = _useState4[0],\n    setIndividualMargin = _useState4[1];\n  var _useState5 = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false),\n    _useState6 = _slicedToArray(_useState5, 2),\n    individualBorderRadius = _useState6[0],\n    setIndividualBorderRadius = _useState6[1];\n  var blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__.useBlockProps)({\n    style: {\n      width: width,\n      backgroundColor: backgroundColor,\n      color: textColor,\n      padding: individualPadding ? \"\".concat(paddingTop, \"px \").concat(paddingRight, \"px \").concat(paddingBottom, \"px \").concat(paddingLeft, \"px\") : \"\".concat(padding, \"px\"),\n      margin: individualMargin ? \"\".concat(marginTop, \"px \").concat(marginRight, \"px \").concat(marginBottom, \"px \").concat(marginLeft, \"px\") : \"\".concat(margin, \"px\"),\n      fontSize: \"\".concat(fontSize, \"px\"),\n      borderRadius: individualBorderRadius ? \"\".concat(borderRadiusTopLeft, \"px \").concat(borderRadiusTopRight, \"px \").concat(borderRadiusBottomRight, \"px \").concat(borderRadiusBottomLeft, \"px\") : \"\".concat(borderRadius, \"px\"),\n      display: 'flex',\n      alignItems: 'center',\n      justifyContent: 'center',\n      minHeight: '3rem'\n    }\n  });\n  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__.InspectorControls, null, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelBody, {\n    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Button Settings', 'trademate'),\n    initialOpen: true\n  }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.TextControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Button Label', 'trademate'),\n    value: label,\n    onChange: function onChange(value) {\n      return setAttributes({\n        label: value\n      });\n    }\n  }), /*#__PURE__*/React.createElement(\"div\", {\n    style: {\n      marginBottom: '10px'\n    }\n  }, /*#__PURE__*/React.createElement(\"strong\", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Button Width', 'trademate'))), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ButtonGroup, {\n    className: \"button-width-group\"\n  }, ['25%', '50%', '75%', '100%'].map(function (size) {\n    return /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {\n      key: size,\n      variant: width === size ? 'primary' : 'secondary',\n      onClick: function onClick() {\n        return setAttributes({\n          width: size\n        });\n      }\n    }, size);\n  })), /*#__PURE__*/React.createElement(\"div\", {\n    style: {\n      marginTop: '10px'\n    }\n  }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Font Size', 'trademate'),\n    value: fontSize,\n    onChange: function onChange(value) {\n      return setAttributes({\n        fontSize: value\n      });\n    },\n    min: 10,\n    max: 40\n  }))), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelBody, {\n    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding Settings', 'trademate'),\n    initialOpen: false\n  }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ToggleControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Individual Padding Control'),\n    checked: individualPadding,\n    onChange: function onChange() {\n      return setIndividualPadding(!individualPadding);\n    }\n  }), individualPadding ? /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding Top', 'trademate'),\n    value: paddingTop,\n    onChange: function onChange(value) {\n      return setAttributes({\n        paddingTop: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding Right', 'trademate'),\n    value: paddingRight,\n    onChange: function onChange(value) {\n      return setAttributes({\n        paddingRight: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding Bottom', 'trademate'),\n    value: paddingBottom,\n    onChange: function onChange(value) {\n      return setAttributes({\n        paddingBottom: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding Left', 'trademate'),\n    value: paddingLeft,\n    onChange: function onChange(value) {\n      return setAttributes({\n        paddingLeft: value\n      });\n    },\n    min: 0,\n    max: 50\n  })) : /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Padding', 'trademate'),\n    value: padding,\n    onChange: function onChange(value) {\n      return setAttributes({\n        padding: value\n      });\n    },\n    min: 0,\n    max: 50\n  })), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelBody, {\n    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin Settings', 'trademate'),\n    initialOpen: false\n  }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ToggleControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Individual Margin Control'),\n    checked: individualMargin,\n    onChange: function onChange() {\n      return setIndividualMargin(!individualMargin);\n    }\n  }), individualMargin ? /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin Top', 'trademate'),\n    value: marginTop,\n    onChange: function onChange(value) {\n      return setAttributes({\n        marginTop: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin Right', 'trademate'),\n    value: marginRight,\n    onChange: function onChange(value) {\n      return setAttributes({\n        marginRight: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin Bottom', 'trademate'),\n    value: marginBottom,\n    onChange: function onChange(value) {\n      return setAttributes({\n        marginBottom: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin Left', 'trademate'),\n    value: marginLeft,\n    onChange: function onChange(value) {\n      return setAttributes({\n        marginLeft: value\n      });\n    },\n    min: 0,\n    max: 50\n  })) : /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Margin', 'trademate'),\n    value: margin,\n    onChange: function onChange(value) {\n      return setAttributes({\n        margin: value\n      });\n    },\n    min: 0,\n    max: 50\n  })), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.PanelBody, {\n    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Border Radius Settings', 'trademate'),\n    initialOpen: false\n  }, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ToggleControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Individual Border Radius Control'),\n    checked: individualBorderRadius,\n    onChange: function onChange() {\n      return setIndividualBorderRadius(!individualBorderRadius);\n    }\n  }), individualBorderRadius ? /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Top Left Radius', 'trademate'),\n    value: borderRadiusTopLeft,\n    onChange: function onChange(value) {\n      return setAttributes({\n        borderRadiusTopLeft: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Top Right Radius', 'trademate'),\n    value: borderRadiusTopRight,\n    onChange: function onChange(value) {\n      return setAttributes({\n        borderRadiusTopRight: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Bottom Right Radius', 'trademate'),\n    value: borderRadiusBottomRight,\n    onChange: function onChange(value) {\n      return setAttributes({\n        borderRadiusBottomRight: value\n      });\n    },\n    min: 0,\n    max: 50\n  }), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Bottom Left Radius', 'trademate'),\n    value: borderRadiusBottomLeft,\n    onChange: function onChange(value) {\n      return setAttributes({\n        borderRadiusBottomLeft: value\n      });\n    },\n    min: 0,\n    max: 50\n  })) : /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.RangeControl, {\n    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Border Radius', 'trademate'),\n    value: borderRadius,\n    onChange: function onChange(value) {\n      return setAttributes({\n        borderRadius: value\n      });\n    },\n    min: 0,\n    max: 50\n  })), /*#__PURE__*/React.createElement(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__.PanelColorSettings, {\n    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Color Settings', 'trademate'),\n    initialOpen: false,\n    colorSettings: [{\n      value: backgroundColor,\n      onChange: function onChange(color) {\n        return setAttributes({\n          backgroundColor: color\n        });\n      },\n      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Background Color', 'trademate')\n    }, {\n      value: textColor,\n      onChange: function onChange(color) {\n        return setAttributes({\n          textColor: color\n        });\n      },\n      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Text Color', 'trademate')\n    }]\n  })), /*#__PURE__*/React.createElement(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, _extends({}, blockProps, {\n    variant: \"primary\"\n  }), label));\n};\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Edit);\n\n//# sourceURL=webpack://trademate/./src/blocks/clear-cart-button/edit.js?");

/***/ }),

/***/ "./src/blocks/clear-cart-button/index.js":
/*!***********************************************!*\
  !*** ./src/blocks/clear-cart-button/index.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ \"@wordpress/blocks\");\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./edit */ \"./src/blocks/clear-cart-button/edit.js\");\n/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./save */ \"./src/blocks/clear-cart-button/save.js\");\n/* harmony import */ var _settings__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./settings */ \"./src/blocks/clear-cart-button/settings.js\");\nfunction _typeof(o) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && \"function\" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? \"symbol\" : typeof o; }, _typeof(o); }\nfunction ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }\nfunction _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }\nfunction _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }\nfunction _toPropertyKey(t) { var i = _toPrimitive(t, \"string\"); return \"symbol\" == _typeof(i) ? i : i + \"\"; }\nfunction _toPrimitive(t, r) { if (\"object\" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || \"default\"); if (\"object\" != _typeof(i)) return i; throw new TypeError(\"@@toPrimitive must return a primitive value.\"); } return (\"string\" === r ? String : Number)(t); }\n\n\n\n\n(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)('trademate/clear-cart-button', _objectSpread(_objectSpread({}, _settings__WEBPACK_IMPORTED_MODULE_3__[\"default\"]), {}, {\n  edit: _edit__WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  save: _save__WEBPACK_IMPORTED_MODULE_2__[\"default\"]\n}));\n\n//# sourceURL=webpack://trademate/./src/blocks/clear-cart-button/index.js?");

/***/ }),

/***/ "./src/blocks/clear-cart-button/save.js":
/*!**********************************************!*\
  !*** ./src/blocks/clear-cart-button/save.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__);\nfunction _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }\n\nvar Save = function Save(_ref) {\n  var attributes = _ref.attributes;\n  var label = attributes.label,\n    width = attributes.width,\n    backgroundColor = attributes.backgroundColor,\n    textColor = attributes.textColor,\n    padding = attributes.padding,\n    paddingTop = attributes.paddingTop,\n    paddingRight = attributes.paddingRight,\n    paddingBottom = attributes.paddingBottom,\n    paddingLeft = attributes.paddingLeft,\n    margin = attributes.margin,\n    marginTop = attributes.marginTop,\n    marginRight = attributes.marginRight,\n    marginBottom = attributes.marginBottom,\n    marginLeft = attributes.marginLeft,\n    fontSize = attributes.fontSize,\n    borderRadius = attributes.borderRadius,\n    borderRadiusTopLeft = attributes.borderRadiusTopLeft,\n    borderRadiusTopRight = attributes.borderRadiusTopRight,\n    borderRadiusBottomRight = attributes.borderRadiusBottomRight,\n    borderRadiusBottomLeft = attributes.borderRadiusBottomLeft,\n    individualPadding = attributes.individualPadding,\n    individualMargin = attributes.individualMargin,\n    individualBorderRadius = attributes.individualBorderRadius;\n  var paddingStyle = individualPadding ? \"\".concat(paddingTop, \"px \").concat(paddingRight, \"px \").concat(paddingBottom, \"px \").concat(paddingLeft, \"px\") : \"\".concat(padding, \"px\");\n  var marginStyle = individualMargin ? \"\".concat(marginTop, \"px \").concat(marginRight, \"px \").concat(marginBottom, \"px \").concat(marginLeft, \"px\") : \"\".concat(margin, \"px\");\n  var borderRadiusStyle = individualBorderRadius ? \"\".concat(borderRadiusTopLeft, \"px \").concat(borderRadiusTopRight, \"px \").concat(borderRadiusBottomRight, \"px \").concat(borderRadiusBottomLeft, \"px\") : \"\".concat(borderRadius, \"px\");\n  var blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__.useBlockProps.save({\n    style: {\n      width: width,\n      backgroundColor: backgroundColor,\n      color: textColor,\n      padding: paddingStyle,\n      margin: marginStyle,\n      fontSize: \"\".concat(fontSize, \"px\"),\n      borderRadius: borderRadiusStyle,\n      display: 'flex',\n      alignItems: 'center',\n      justifyContent: 'center',\n      minHeight: '3rem'\n    }\n  });\n  return /*#__PURE__*/React.createElement(\"button\", _extends({}, blockProps, {\n    className: \"clear-cart-button button\",\n    type: \"button\"\n  }), label);\n};\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Save);\n\n//# sourceURL=webpack://trademate/./src/blocks/clear-cart-button/save.js?");

/***/ }),

/***/ "./src/blocks/clear-cart-button/settings.js":
/*!**************************************************!*\
  !*** ./src/blocks/clear-cart-button/settings.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ \"@wordpress/i18n\");\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);\n\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  apiVersion: 3,\n  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Clear Cart Button', 'trademate'),\n  icon: 'cart',\n  category: 'woocommerce',\n  parent: [\"woocommerce/cart-totals-block\"],\n  attributes: {\n    label: {\n      type: 'string',\n      \"default\": (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__.__)('Clear Cart', 'trademate')\n    },\n    width: {\n      type: 'string',\n      \"default\": '100%'\n    },\n    backgroundColor: {\n      type: 'string',\n      \"default\": '#cf2e2e'\n    },\n    textColor: {\n      type: 'string',\n      \"default\": '#ffffff'\n    },\n    padding: {\n      type: 'number',\n      \"default\": 0\n    },\n    paddingTop: {\n      type: 'number',\n      \"default\": 10\n    },\n    paddingRight: {\n      type: 'number',\n      \"default\": 10\n    },\n    paddingBottom: {\n      type: 'number',\n      \"default\": 10\n    },\n    paddingLeft: {\n      type: 'number',\n      \"default\": 10\n    },\n    margin: {\n      type: 'number',\n      \"default\": 0\n    },\n    marginTop: {\n      type: 'number',\n      \"default\": 10\n    },\n    marginRight: {\n      type: 'number',\n      \"default\": 10\n    },\n    marginBottom: {\n      type: 'number',\n      \"default\": 10\n    },\n    marginLeft: {\n      type: 'number',\n      \"default\": 10\n    },\n    fontSize: {\n      type: 'number',\n      \"default\": 16\n    },\n    borderRadius: {\n      type: 'number',\n      \"default\": 0\n    },\n    borderRadiusTopLeft: {\n      type: 'number',\n      \"default\": 5\n    },\n    borderRadiusTopRight: {\n      type: 'number',\n      \"default\": 5\n    },\n    borderRadiusBottomRight: {\n      type: 'number',\n      \"default\": 5\n    },\n    borderRadiusBottomLeft: {\n      type: 'number',\n      \"default\": 5\n    }\n  }\n});\n\n//# sourceURL=webpack://trademate/./src/blocks/clear-cart-button/settings.js?");

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = wp.blockEditor;

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = wp.blocks;

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = wp.components;

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = wp.element;

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = wp.i18n;

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
/******/ 	var __webpack_exports__ = __webpack_require__("./src/blocks/clear-cart-button/index.js");
/******/ 	
/******/ })()
;