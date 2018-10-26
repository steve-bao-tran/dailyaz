/* Simple AJAX Code-Kit (SACK) v1.6.1 */
/* ©2005 Gregory Wild-Smith */
/* www.twilightuniverse.com */
/* Software licenced under a modified X11 licence,
   see documentation or authors website for more details */

/*
$layout->importJsLib('ajax');

//script
var ajax = new SAjax();

function whenLoading(){
	var e = document.getElementById('replaceme'); 
	e.innerHTML = "<p>Sending Data...</p>";
}

function whenLoaded(){
	var e = document.getElementById('replaceme'); 
	e.innerHTML = "<p>Data Sent...</p>";
}

function whenInteractive(){
	var e = document.getElementById('replaceme'); 
	e.innerHTML = "<p>getting data...</p>";
}

function whenCompleted(){
	var e = document.getElementById('sackdata'); 
	if (ajax.responseStatus){
		var string = "<p>Status Code: " + ajax.responseStatus[0] + "</p><p>Status Message: " + ajax.responseStatus[1] + "</p><p>URLString Sent: " + ajax.URLString + "</p>";
	} else {
		var string = "<p>URLString Sent: " + ajax.URLString + "</p>";
	}
	e.innerHTML = string;	
}

function doit(){
	var form = document.getElementById('form');
	ajax.setVar("myTextBox", form.mytext.value); // recomended method of setting data to be parsed.
	ajax.requestFile = "sackdemo.php";
	ajax.method = form.method.value;
	ajax.element = 'replaceme';
	ajax.onLoading = whenLoading;
	ajax.onLoaded = whenLoaded; 
	ajax.onInteractive = whenInteractive;
	ajax.onCompletion = whenCompleted;
	ajax.runAJAX();
}

<form id="form" method="post" action="sackdemo.php">
<fieldset><legend>Play with these to change the output...</legend>
	<label for="method">Method</label>
	<select id="method" name="method">
		<option value="GET">GET</option>
		<option value="POST">POST</option>
	</select>
	<label for="mytext">Mytext(custom text)</label><textarea id="mytext" name="mytext">Some Dummy Text...</textarea>
</fieldset>
	<input type="submit" onClick="doit(); return false;" onDblClick="doit(); return false;" />
</form>


*/ 
function SAjax(file)
{
	if(!file) file = 'index.php';
	this.xmlhttp = null;

	this.resetData = function() 
	{
		this.method = "POST";
  		this.queryStringSeparator = "?";
		this.argumentSeparator = "&";
		this.URLString = "";
		this.encodeURIString = true;
  		this.execute = false;
  		this.element = null;
		this.elementObj = null;
		this.requestFile = file;
		this.vars = new Object();
		this.responseStatus = new Array(2);
  	};

	this.resetFunctions = function() 
	{
  		this.onLoading = function() 
		{	
			var e = getObj(this.element); 
			e.innerHTML = '<img src="images/loading.gif" />';
 		};
  		this.onLoaded = function() { };
  		this.onInteractive = function() 
		{ 
			var e = getObj(this.element); 
			e.innerHTML = '<img src="images/loading.gif" />';
		};
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.onFail = function() { };
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function() {
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}

		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.setVar = function(name, value){
		this.vars[name] = Array(value, false);
	};

	this.encVar = function(name, value, returnvars) {
		if (true == returnvars) {
			return Array(encodeURIComponent(name), encodeURIComponent(value));
		} else {
			this.vars[encodeURIComponent(name)] = Array(encodeURIComponent(value), true);
		}
	}

	this.processURLString = function(string, encode) {
		encoded = encodeURIComponent(this.argumentSeparator);
		regexp = new RegExp(this.argumentSeparator + "|" + encoded);
		varArray = string.split(regexp);
		for (i = 0; i < varArray.length; i++){
			urlVars = varArray[i].split("=");
			if (true == encode){
				this.encVar(urlVars[0], urlVars[1]);
			} else {
				this.setVar(urlVars[0], urlVars[1]);
			}
		}
	}

	this.createURLString = function(urlstring) {
		if (this.encodeURIString && this.URLString.length) {
			this.processURLString(this.URLString, true);
		}

		if (urlstring) {
			if (this.URLString.length) {
				this.URLString += this.argumentSeparator + urlstring;
			} else {
				this.URLString = urlstring;
			}
		}

		// prevents caching of URLString
		this.setVar("rndval", new Date().getTime());

		urlstringtemp = new Array();
		for (key in this.vars) {
			if (false == this.vars[key][1] && true == this.encodeURIString) {
				encoded = this.encVar(key, this.vars[key][0], true);
				delete this.vars[key];
				this.vars[encoded[0]] = Array(encoded[1], true);
				key = encoded[0];
			}

			urlstringtemp[urlstringtemp.length] = key + "=" + this.vars[key][0];
		}
		if (urlstring){
			this.URLString += this.argumentSeparator + urlstringtemp.join(this.argumentSeparator);
		} else {
			this.URLString += urlstringtemp.join(this.argumentSeparator);
		}
	}

	this.runResponse = function() {
		eval(this.response);
	}

	this.runAJAX = function(urlstring) {
		if (this.failed) {
			this.onFail();
		} else {
			this.createURLString(urlstring);
			if (this.element) {
				this.elementObj = document.getElementById(this.element);
			}
			if (this.xmlhttp) {
				var self = this;
				if (this.method == "GET") {
					totalurlstring = this.requestFile + this.queryStringSeparator + this.URLString;
					this.xmlhttp.open(this.method, totalurlstring, true);
				} else {
					this.xmlhttp.open(this.method, this.requestFile, true);
					try {
						this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
					} catch (e) { }
				}

				this.xmlhttp.onreadystatechange = function() {
					switch (self.xmlhttp.readyState) {
						case 1:
							self.onLoading();
							break;
						case 2:
							self.onLoaded();
							break;
						case 3:
							self.onInteractive();
							break;
						case 4:
							self.response = self.xmlhttp.responseText;
							self.responseXML = self.xmlhttp.responseXML;
							self.responseStatus[0] = self.xmlhttp.status;
							self.responseStatus[1] = self.xmlhttp.statusText;

							if (self.execute) {
								self.runResponse();
							}

							if (self.elementObj) {
								elemNodeName = self.elementObj.nodeName;
								elemNodeName.toLowerCase();
								if (elemNodeName == "input"
								|| elemNodeName == "select"
								|| elemNodeName == "option"
								|| elemNodeName == "textarea") {
									self.elementObj.value = self.response;
								} else {
									self.elementObj.innerHTML = self.response;
								}
							}
							if (self.responseStatus[0] == "200") {
								self.onCompletion();
							} else {
								self.onError();
							}

							self.URLString = "";
							break;
					}
				};

				this.xmlhttp.send(this.URLString);
			}
		}
	};

	this.reset();
	this.createAJAX();
	this.setVar('tpl','m');
}