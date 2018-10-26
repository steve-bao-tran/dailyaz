// JavaScript Document
function getObj( id ){
	return document.getElementById(id);
}
/* get Max heigh (all items) */
function getMaxHeight( classNameStr ){
	var lis = document.getElementsByClassName(classNameStr);
	if(lis.length){
		var h = lis[0].offsetHeight;
		for(i = 0; i < lis.length; i++)
		{
			var li = lis[i];
			if( li.offsetHeight > h) 
			{
				h = li.offsetHeight ; 
			}
		}
		return h;
	}

}

function compareItemsHeight( strClassName ){
	var lis = document.getElementsByClassName(strClassName); 
	
	var h = getMaxHeight(strClassName);
	for(i = 0; i < lis.length; i++)
	{
		var li = lis[i];
		li.style.height = h+'px';
	}

}

 function pressButton(button){ 
 	obj = document.adminForm;
	obj.t.value = button;
	obj.submit();
 }
 
 function markRow( i, ischeckbox )
{
	var cb = getObj('cb'+i);
	var r = getObj('tblrow'+i);
	
	var isCheckcb = cb.checked;
	if( ischeckbox )
	{ 
		if(isCheckcb == true)
		{
			cb.checked = false;
		}else{
			cb.checked = true;
		}
	}
	else
	{
	
		if(isCheckcb == true)
		{
			cb.checked = false;
			document.adminForm.boxchecked.value--;
			if(r.className=='mark')
			{
				if( i%2==0 ) r.className = 'r0';
				else r.className = 'r1';
			}
		}else{
			cb.checked = true;
			document.adminForm.boxchecked.value++;
			r.className = 'mark';
		}
	
	}
}

function tblListOrder( fieldName, dir, task ) 
{
	var form = document.adminForm;
	form.order_field.value 	= fieldName;
	form.order_dir.value	= dir;
	submitform( task );
}


function checkAll( n, cbName ) { 
  if (!cbName) {
     cbName = 'cb';
  }
	var frm = document.adminForm;
	var c = frm.cbcheckall.checked;
	var n2 = 0;
	for (i=0; i < n; i++) {
		cb = eval( 'frm.' + cbName + '' + i );
		var r = getObj('tblrow'+i);
		if (cb) {
			cb.checked = c;
			n2++;
			if( c == true )
				r.className = 'mark';
			else
				r.className = i%2==0 ? 'r0' : 'r1';
		}
	}
	if (c) {
		document.adminForm.boxchecked.value = n2;
	} else {
		document.adminForm.boxchecked.value = 0;
	}
}

function listItemOrder( cbId, orderValue ){
	frm = document.adminForm;
	frm.order.value = orderValue;
	listItemTask(cbId, 'saveorder'); 
}

function listItemOrders(n, task )
{
	cbName = 'cb';
	var frm = document.adminForm;
	for (i=0; i < n; i++) {
		cb = eval( 'frm.' + cbName + '' + i );
		if (cb) {
			cb.checked = true;
		}
	}
	pressButton(task);
}

function listItemTask( id, task ) {
    var frm = document.adminForm;
    cb = eval( 'frm.' + id );
    if (cb) {
        for (i = 0; true; i++) {
            cbx = eval('frm.cb'+i);
            if (!cbx) break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        frm.boxchecked.value = 1;
        submitbutton(task);
    }
    return false;
}

function submitbutton(t) {
	submitform(t);
}

/**
* Submit the admin form
*/
function submitform(task){
	if (task) {
		document.adminForm.t.value = task;
	}
	if (typeof document.adminForm.onsubmit == "function") {
		document.adminForm.onsubmit();
	}
	document.adminForm.submit();
}

function isChecked(isitchecked){
	if (isitchecked == true){
		document.adminForm.boxchecked.value++;
	}
	else {
		document.adminForm.boxchecked.value--;
	}
	
}
function goPage(page){
	document.adminForm.page.value = page;
	submitform();
	return false;
}

// Cookie Functions
function setCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function deleteCookie(name) {
	setCookie(name,"",-1);
}



