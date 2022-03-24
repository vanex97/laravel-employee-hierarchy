/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/reEmploymentForm.js":
/*!******************************************!*\
  !*** ./resources/js/reEmploymentForm.js ***!
  \******************************************/
/***/ (() => {

eval("var CSRF_TOKEN = $('meta[name=\"csrf-token\"]').attr('content');\n$(\".head-input\").each(function () {\n  $(this).autocomplete({\n    source: function source(request, response) {\n      $.ajax({\n        type: \"post\",\n        url: $(\".head-input\").attr('url'),\n        data: {\n          _token: CSRF_TOKEN,\n          term: request.term\n        },\n        dataType: \"json\",\n        success: function success(data) {\n          var resp = $.map(data, function (obj) {\n            return obj.name;\n          });\n          response(resp);\n        }\n      });\n    },\n    minLength: 2\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcmVFbXBsb3ltZW50Rm9ybS5qcz8zMTI3Il0sIm5hbWVzIjpbIkNTUkZfVE9LRU4iLCIkIiwiYXR0ciIsImVhY2giLCJhdXRvY29tcGxldGUiLCJzb3VyY2UiLCJyZXF1ZXN0IiwicmVzcG9uc2UiLCJhamF4IiwidHlwZSIsInVybCIsImRhdGEiLCJfdG9rZW4iLCJ0ZXJtIiwiZGF0YVR5cGUiLCJzdWNjZXNzIiwicmVzcCIsIm1hcCIsIm9iaiIsIm5hbWUiLCJtaW5MZW5ndGgiXSwibWFwcGluZ3MiOiJBQUFBLElBQUlBLFVBQVUsR0FBR0MsQ0FBQyxDQUFDLHlCQUFELENBQUQsQ0FBNkJDLElBQTdCLENBQWtDLFNBQWxDLENBQWpCO0FBQ0FELENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJFLElBQWpCLENBQXNCLFlBQVk7QUFDOUJGLEVBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUcsWUFBUixDQUFxQjtBQUNqQkMsSUFBQUEsTUFBTSxFQUFFLGdCQUFVQyxPQUFWLEVBQW1CQyxRQUFuQixFQUE2QjtBQUNqQ04sTUFBQUEsQ0FBQyxDQUFDTyxJQUFGLENBQU87QUFDSEMsUUFBQUEsSUFBSSxFQUFFLE1BREg7QUFFSEMsUUFBQUEsR0FBRyxFQUFFVCxDQUFDLENBQUMsYUFBRCxDQUFELENBQWlCQyxJQUFqQixDQUFzQixLQUF0QixDQUZGO0FBR0hTLFFBQUFBLElBQUksRUFBRTtBQUNGQyxVQUFBQSxNQUFNLEVBQUVaLFVBRE47QUFFRmEsVUFBQUEsSUFBSSxFQUFFUCxPQUFPLENBQUNPO0FBRlosU0FISDtBQU9IQyxRQUFBQSxRQUFRLEVBQUUsTUFQUDtBQVFIQyxRQUFBQSxPQUFPLEVBQUUsaUJBQVVKLElBQVYsRUFBZ0I7QUFDckIsY0FBSUssSUFBSSxHQUFHZixDQUFDLENBQUNnQixHQUFGLENBQU1OLElBQU4sRUFBWSxVQUFVTyxHQUFWLEVBQWU7QUFDbEMsbUJBQU9BLEdBQUcsQ0FBQ0MsSUFBWDtBQUNILFdBRlUsQ0FBWDtBQUdBWixVQUFBQSxRQUFRLENBQUNTLElBQUQsQ0FBUjtBQUNIO0FBYkUsT0FBUDtBQWVILEtBakJnQjtBQWtCakJJLElBQUFBLFNBQVMsRUFBRTtBQWxCTSxHQUFyQjtBQW9CSCxDQXJCRCIsInNvdXJjZXNDb250ZW50IjpbImxldCBDU1JGX1RPS0VOID0gJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKTtcbiQoXCIuaGVhZC1pbnB1dFwiKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLmF1dG9jb21wbGV0ZSh7XG4gICAgICAgIHNvdXJjZTogZnVuY3Rpb24gKHJlcXVlc3QsIHJlc3BvbnNlKSB7XG4gICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgIHR5cGU6IFwicG9zdFwiLFxuICAgICAgICAgICAgICAgIHVybDogJChcIi5oZWFkLWlucHV0XCIpLmF0dHIoJ3VybCcpLFxuICAgICAgICAgICAgICAgIGRhdGE6IHtcbiAgICAgICAgICAgICAgICAgICAgX3Rva2VuOiBDU1JGX1RPS0VOLFxuICAgICAgICAgICAgICAgICAgICB0ZXJtOiByZXF1ZXN0LnRlcm1cbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgICAgIGRhdGFUeXBlOiBcImpzb25cIixcbiAgICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgICAgICB2YXIgcmVzcCA9ICQubWFwKGRhdGEsIGZ1bmN0aW9uIChvYmopIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBvYmoubmFtZTtcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgIHJlc3BvbnNlKHJlc3ApO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9LFxuICAgICAgICBtaW5MZW5ndGg6IDJcbiAgICB9KTtcbn0pO1xuIl0sImZpbGUiOiIuL3Jlc291cmNlcy9qcy9yZUVtcGxveW1lbnRGb3JtLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/reEmploymentForm.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/reEmploymentForm.js"]();
/******/ 	
/******/ })()
;