/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("Object.defineProperty(__webpack_exports__, \"__esModule\", { value: true });\n/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__breaking_news_block__ = __webpack_require__(1);\n/**\n * Import registerBlockType blocks\n */\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Jsb2Nrcy9pbmRleC5qcz84MTkzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogSW1wb3J0IHJlZ2lzdGVyQmxvY2tUeXBlIGJsb2Nrc1xuICovXG5pbXBvcnQgJy4vYnJlYWtpbmctbmV3cy1ibG9jayc7XG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9ibG9ja3MvaW5kZXguanNcbi8vIG1vZHVsZSBpZCA9IDBcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///0\n");

/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__icon__ = __webpack_require__(2);\n/**\n * BLOCK: reference-block\n *\n * Registering a basic block with Gutenberg.\n * Simple block, renders and saves the same content without any interactivity.\n */\n\n//  Import CSS.\n//import './style.scss';\n//import './editor.scss';\n//import Selecta from './selecta.js';\n\n\n\nvar __ = wp.i18n.__;\nvar _wp$blocks = wp.blocks,\n    InspectorControls = _wp$blocks.InspectorControls,\n    registerBlockType = _wp$blocks.registerBlockType,\n    blockEditRender = _wp$blocks.blockEditRender,\n    Spinner = _wp$blocks.Spinner; // Import registerBlockType() from wp.blocks\n\n//this is where block control componants go! a-ha!\n//const { ToggleControl, SelectControl } = InspectorControls;\n/**\n * Register: aa Gutenberg Block.\n *\n * Registers a new block provided a unique name and an object defining its\n * behavior. Once registered, the block is made editor as an option to any\n * editor interface where blocks are implemented.\n *\n * @param  {string}   name     Block name.\n * @param  {Object}   settings Block settings.\n * @return {?WPBlock}          The block, if it has been successfully\n *                             registered; otherwise `undefined`.\n */\n\nregisterBlockType('jm-breaking-news/jm-live-blog-block', {\n    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.\n    title: __('JM Breaking News', 'jm-breaking-news'),\n    icon: 'lightbulb', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.\n    category: 'widgets', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.\n    keywords: [__('JM Breaking News', 'jm-breaking-news'), __('breaking news', 'jm-breaking-news'), __('news', 'jm-breaking-news')],\n    attributes: {},\n\n    // The \"edit\" property must be a valid function.\n    edit: function edit(_ref) {\n        var attributes = _ref.attributes,\n            setAttributes = _ref.setAttributes,\n            focus = _ref.focus,\n            setFocus = _ref.setFocus,\n            className = _ref.className;\n\n        return [wp.element.createElement(\n            'div',\n            { className: className },\n            wp.element.createElement(\n                'h2',\n                null,\n                __('JM Breaking News', 'jm-breaking-news')\n            ),\n            wp.element.createElement(\n                'p',\n                null,\n                __('The JM Breaking News  isn\\'t directly editable. You can control the look of the breaking news item when creating a new breaking news item.', 'jm-breaking-news')\n            )\n        )];\n    },\n\n\n    // The \"save\" property must be specified and must be a valid function.\n    //this is what puts the html in the \"edit as html\" box\n    save: function save() {\n        return null;\n    }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Jsb2Nrcy9icmVha2luZy1uZXdzLWJsb2NrL2luZGV4LmpzPzQ0NDkiXSwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBCTE9DSzogcmVmZXJlbmNlLWJsb2NrXG4gKlxuICogUmVnaXN0ZXJpbmcgYSBiYXNpYyBibG9jayB3aXRoIEd1dGVuYmVyZy5cbiAqIFNpbXBsZSBibG9jaywgcmVuZGVycyBhbmQgc2F2ZXMgdGhlIHNhbWUgY29udGVudCB3aXRob3V0IGFueSBpbnRlcmFjdGl2aXR5LlxuICovXG5cbi8vICBJbXBvcnQgQ1NTLlxuLy9pbXBvcnQgJy4vc3R5bGUuc2Nzcyc7XG4vL2ltcG9ydCAnLi9lZGl0b3Iuc2Nzcyc7XG4vL2ltcG9ydCBTZWxlY3RhIGZyb20gJy4vc2VsZWN0YS5qcyc7XG5cbmltcG9ydCBpY29uIGZyb20gJy4vaWNvbic7XG5cbnZhciBfXyA9IHdwLmkxOG4uX187XG52YXIgX3dwJGJsb2NrcyA9IHdwLmJsb2NrcyxcbiAgICBJbnNwZWN0b3JDb250cm9scyA9IF93cCRibG9ja3MuSW5zcGVjdG9yQ29udHJvbHMsXG4gICAgcmVnaXN0ZXJCbG9ja1R5cGUgPSBfd3AkYmxvY2tzLnJlZ2lzdGVyQmxvY2tUeXBlLFxuICAgIGJsb2NrRWRpdFJlbmRlciA9IF93cCRibG9ja3MuYmxvY2tFZGl0UmVuZGVyLFxuICAgIFNwaW5uZXIgPSBfd3AkYmxvY2tzLlNwaW5uZXI7IC8vIEltcG9ydCByZWdpc3RlckJsb2NrVHlwZSgpIGZyb20gd3AuYmxvY2tzXG5cbi8vdGhpcyBpcyB3aGVyZSBibG9jayBjb250cm9sIGNvbXBvbmFudHMgZ28hIGEtaGEhXG4vL2NvbnN0IHsgVG9nZ2xlQ29udHJvbCwgU2VsZWN0Q29udHJvbCB9ID0gSW5zcGVjdG9yQ29udHJvbHM7XG4vKipcbiAqIFJlZ2lzdGVyOiBhYSBHdXRlbmJlcmcgQmxvY2suXG4gKlxuICogUmVnaXN0ZXJzIGEgbmV3IGJsb2NrIHByb3ZpZGVkIGEgdW5pcXVlIG5hbWUgYW5kIGFuIG9iamVjdCBkZWZpbmluZyBpdHNcbiAqIGJlaGF2aW9yLiBPbmNlIHJlZ2lzdGVyZWQsIHRoZSBibG9jayBpcyBtYWRlIGVkaXRvciBhcyBhbiBvcHRpb24gdG8gYW55XG4gKiBlZGl0b3IgaW50ZXJmYWNlIHdoZXJlIGJsb2NrcyBhcmUgaW1wbGVtZW50ZWQuXG4gKlxuICogQHBhcmFtICB7c3RyaW5nfSAgIG5hbWUgICAgIEJsb2NrIG5hbWUuXG4gKiBAcGFyYW0gIHtPYmplY3R9ICAgc2V0dGluZ3MgQmxvY2sgc2V0dGluZ3MuXG4gKiBAcmV0dXJuIHs/V1BCbG9ja30gICAgICAgICAgVGhlIGJsb2NrLCBpZiBpdCBoYXMgYmVlbiBzdWNjZXNzZnVsbHlcbiAqICAgICAgICAgICAgICAgICAgICAgICAgICAgICByZWdpc3RlcmVkOyBvdGhlcndpc2UgYHVuZGVmaW5lZGAuXG4gKi9cblxucmVnaXN0ZXJCbG9ja1R5cGUoJ2ptLWJyZWFraW5nLW5ld3Mvam0tYnJlYWtpbmctbmV3cy1ibG9jaycsIHtcbiAgICAvLyBCbG9jayBuYW1lLiBCbG9jayBuYW1lcyBtdXN0IGJlIHN0cmluZyB0aGF0IGNvbnRhaW5zIGEgbmFtZXNwYWNlIHByZWZpeC4gRXhhbXBsZTogbXktcGx1Z2luL215LWN1c3RvbS1ibG9jay5cbiAgICB0aXRsZTogX18oJ0pNIEJyZWFraW5nIE5ld3MnLCAnam0tYnJlYWtpbmctbmV3cycpLFxuICAgIGljb246ICdsaWdodGJ1bGInLCAvLyBCbG9jayBpY29uIGZyb20gRGFzaGljb25zIOKGkiBodHRwczovL2RldmVsb3Blci53b3JkcHJlc3Mub3JnL3Jlc291cmNlL2Rhc2hpY29ucy8uXG4gICAgY2F0ZWdvcnk6ICd3aWRnZXRzJywgLy8gQmxvY2sgY2F0ZWdvcnkg4oCUIEdyb3VwIGJsb2NrcyB0b2dldGhlciBiYXNlZCBvbiBjb21tb24gdHJhaXRzIEUuZy4gY29tbW9uLCBmb3JtYXR0aW5nLCBsYXlvdXQgd2lkZ2V0cywgZW1iZWQuXG4gICAga2V5d29yZHM6IFtfXygnSk0gQnJlYWtpbmcgTmV3cycsICdqbS1icmVha2luZy1uZXdzJyksIF9fKCdicmVha2luZyBuZXdzJywgJ2ptLWJyZWFraW5nLW5ld3MnKSwgX18oJ25ld3MnLCAnam0tYnJlYWtpbmctbmV3cycpXSxcbiAgICBhdHRyaWJ1dGVzOiB7fSxcblxuICAgIC8vIFRoZSBcImVkaXRcIiBwcm9wZXJ0eSBtdXN0IGJlIGEgdmFsaWQgZnVuY3Rpb24uXG4gICAgZWRpdDogZnVuY3Rpb24gZWRpdChfcmVmKSB7XG4gICAgICAgIHZhciBhdHRyaWJ1dGVzID0gX3JlZi5hdHRyaWJ1dGVzLFxuICAgICAgICAgICAgc2V0QXR0cmlidXRlcyA9IF9yZWYuc2V0QXR0cmlidXRlcyxcbiAgICAgICAgICAgIGZvY3VzID0gX3JlZi5mb2N1cyxcbiAgICAgICAgICAgIHNldEZvY3VzID0gX3JlZi5zZXRGb2N1cyxcbiAgICAgICAgICAgIGNsYXNzTmFtZSA9IF9yZWYuY2xhc3NOYW1lO1xuXG4gICAgICAgIHJldHVybiBbd3AuZWxlbWVudC5jcmVhdGVFbGVtZW50KFxuICAgICAgICAgICAgJ2RpdicsXG4gICAgICAgICAgICB7IGNsYXNzTmFtZTogY2xhc3NOYW1lIH0sXG4gICAgICAgICAgICB3cC5lbGVtZW50LmNyZWF0ZUVsZW1lbnQoXG4gICAgICAgICAgICAgICAgJ2gyJyxcbiAgICAgICAgICAgICAgICBudWxsLFxuICAgICAgICAgICAgICAgIF9fKCdKTSBCcmVha2luZyBOZXdzJywgJ2ptLWJyZWFraW5nLW5ld3MnKVxuICAgICAgICAgICAgKSxcbiAgICAgICAgICAgIHdwLmVsZW1lbnQuY3JlYXRlRWxlbWVudChcbiAgICAgICAgICAgICAgICAncCcsXG4gICAgICAgICAgICAgICAgbnVsbCxcbiAgICAgICAgICAgICAgICBfXygnVGhlIEpNIEJyZWFraW5nIE5ld3MgIGlzblxcJ3QgZGlyZWN0bHkgZWRpdGFibGUuIFlvdSBjYW4gY29udHJvbCB0aGUgbG9vayBvZiB0aGUgYnJlYWtpbmcgbmV3cyBpdGVtIHdoZW4gY3JlYXRpbmcgYSBuZXcgYnJlYWtpbmcgbmV3cyBpdGVtLicsICdqbS1icmVha2luZy1uZXdzJylcbiAgICAgICAgICAgIClcbiAgICAgICAgKV07XG4gICAgfSxcblxuXG4gICAgLy8gVGhlIFwic2F2ZVwiIHByb3BlcnR5IG11c3QgYmUgc3BlY2lmaWVkIGFuZCBtdXN0IGJlIGEgdmFsaWQgZnVuY3Rpb24uXG4gICAgLy90aGlzIGlzIHdoYXQgcHV0cyB0aGUgaHRtbCBpbiB0aGUgXCJlZGl0IGFzIGh0bWxcIiBib3hcbiAgICBzYXZlOiBmdW5jdGlvbiBzYXZlKCkge1xuICAgICAgICByZXR1cm4gbnVsbDtcbiAgICB9XG59KTtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL2Jsb2Nrcy9icmVha2luZy1uZXdzLWJsb2NrL2luZGV4LmpzXG4vLyBtb2R1bGUgaWQgPSAxXG4vLyBtb2R1bGUgY2h1bmtzID0gMCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///1\n");

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("var icon = wp.element.createElement(\n    'svg',\n    { width: '20px', height: '20px', viewBox: '0 0 100 100', xmlns: 'http://www.w3.org/2000/svg' },\n    wp.element.createElement('path', { d: 'm43.75 87.5h-6.25v-75h6.25c3.4531 0 6.25-2.7969 6.25-6.25s-2.7969-6.25-6.25-6.25h-6.25c-6.25 0-6.25 6.25-6.25 6.25s0-6.25-6.25-6.25h-6.25c-3.4531 0-6.25 2.7969-6.25 6.25s2.7969 6.25 6.25 6.25h6.25v12.5h-18.75c-3.4531 0-6.25 2.7969-6.25 6.25v37.5c0 3.4531 2.7969 6.25 6.25 6.25h18.75v12.5h-6.25c-3.4531 0-6.25 2.7969-6.25 6.25s2.7969 6.25 6.25 6.25h6.25c6.25 0 6.25-6.25 6.25-6.25s0 6.25 6.25 6.25h6.25c3.4531 0 6.25-2.7969 6.25-6.25s-2.7969-6.25-6.25-6.25zm-18.75-18.75h-18.75v-37.5h18.75zm75-37.5v37.5c0 3.4531-2.7969 6.25-6.25 6.25h-50v-6.25h50v-37.5h-50v-6.25h50c3.4531 0 6.25 2.7969 6.25 6.25z'\n    })\n);\n\n/* unused harmony default export */ var _unused_webpack_default_export = (icon);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMi5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Jsb2Nrcy9icmVha2luZy1uZXdzLWJsb2NrL2ljb24uanM/ZGEyYSJdLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgaWNvbiA9IHdwLmVsZW1lbnQuY3JlYXRlRWxlbWVudChcbiAgICAnc3ZnJyxcbiAgICB7IHdpZHRoOiAnMjBweCcsIGhlaWdodDogJzIwcHgnLCB2aWV3Qm94OiAnMCAwIDEwMCAxMDAnLCB4bWxuczogJ2h0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnJyB9LFxuICAgIHdwLmVsZW1lbnQuY3JlYXRlRWxlbWVudCgncGF0aCcsIHsgZDogJ200My43NSA4Ny41aC02LjI1di03NWg2LjI1YzMuNDUzMSAwIDYuMjUtMi43OTY5IDYuMjUtNi4yNXMtMi43OTY5LTYuMjUtNi4yNS02LjI1aC02LjI1Yy02LjI1IDAtNi4yNSA2LjI1LTYuMjUgNi4yNXMwLTYuMjUtNi4yNS02LjI1aC02LjI1Yy0zLjQ1MzEgMC02LjI1IDIuNzk2OS02LjI1IDYuMjVzMi43OTY5IDYuMjUgNi4yNSA2LjI1aDYuMjV2MTIuNWgtMTguNzVjLTMuNDUzMSAwLTYuMjUgMi43OTY5LTYuMjUgNi4yNXYzNy41YzAgMy40NTMxIDIuNzk2OSA2LjI1IDYuMjUgNi4yNWgxOC43NXYxMi41aC02LjI1Yy0zLjQ1MzEgMC02LjI1IDIuNzk2OS02LjI1IDYuMjVzMi43OTY5IDYuMjUgNi4yNSA2LjI1aDYuMjVjNi4yNSAwIDYuMjUtNi4yNSA2LjI1LTYuMjVzMCA2LjI1IDYuMjUgNi4yNWg2LjI1YzMuNDUzMSAwIDYuMjUtMi43OTY5IDYuMjUtNi4yNXMtMi43OTY5LTYuMjUtNi4yNS02LjI1em0tMTguNzUtMTguNzVoLTE4Ljc1di0zNy41aDE4Ljc1em03NS0zNy41djM3LjVjMCAzLjQ1MzEtMi43OTY5IDYuMjUtNi4yNSA2LjI1aC01MHYtNi4yNWg1MHYtMzcuNWgtNTB2LTYuMjVoNTBjMy40NTMxIDAgNi4yNSAyLjc5NjkgNi4yNSA2LjI1eidcbiAgICB9KVxuKTtcblxuZXhwb3J0IGRlZmF1bHQgaWNvbjtcblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL2Jsb2Nrcy9icmVha2luZy1uZXdzLWJsb2NrL2ljb24uanNcbi8vIG1vZHVsZSBpZCA9IDJcbi8vIG1vZHVsZSBjaHVua3MgPSAwIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///2\n");

/***/ })
/******/ ]);