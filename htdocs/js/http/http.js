/*
 |
 | http request object
 |
 */

var http = {};

/*
 |
 | http.constructor
 |
 */

http.http = function () {
    var that = {}, http = this, connect = http.connect(), encode;

    encode = function (data) {
	var name, value, regexp = /%20/g, string = '';

	for (name in data) {
	    value = data[name];
	    string += encodeURIComponent(name);
	    string += '=';
	    string += encodeURIComponent(value).replace(regexp, "+");
	    string += '&';
	}

	return string.slice(0, -1);
    };

    that.context = function () {
	var args, success, error;

	args    = arguments[0] || {};
	success = args.success || http.default_success_callback;
	error   = args.error   || http.default_error_callback;
	
	connect.onreadystatechange = function () {
	    if (connect.readyState === 4) {
		if (connect.status === 200 || obj.status === 201) {
		    success(connect);
		} else {
		    error(connect);
		}
	    }
	};
    };

    that.request = function (args) {
	var data = encode(args.data) || null

	connect.open(args.method, encodeURI(args.path), args.async);

	if (args.method === 'post') {
	    connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	}

	connect.send(data);
    }; 

    return that;
}

/*
 |
 | http.method
 |
 */

http.connect = function () {
    var factories, factory, new_connect;

    factories = [
	function () { return new XMLHttpRequest(); },
	function () { return new ActiveXObject("Msxml2.XMLHTTP"); },
	function () { return new ActiveXObject("Microsoft.XMLHTTP"); }
    ];
    
    factory = null

    return function () {
	var i, request;
	
	if (factory != null) return factory();

	for (i = 0; i < factories.length; i += 1) {
	    try {
		request = (factories[i])();
		if (request != null) {
		    factory = factories[i];
		    return request;
		}
	    } catch (e) {
		continue;
	    }
	}

	factory = function() {
	    throw new Error("XMLHttpRequest not supported");
	}
	
	factory();
    };
}();
 
http.default_success_callback = function (connect) {
    alert(connect.responseText);
};

http.default_error_callback = function (connect) {
    alert('Error ' + connect.status + ': ' + connect.statusText);
};
