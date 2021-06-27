var isCtrlHold = false;
var isShiftHold = false;

$(document).keyup(function (e) {
    if (e.which == 17) //17 is the code of Ctrl button
	isCtrlHold = false;
    if (e.which == 16) //16 is the code of Shift button
	isShiftHold = false;
});
$(document).keydown(function (e) {
    if (e.which == 17)
	isCtrlHold = true;
    if (e.which == 16)
	isShiftHold = true;
    
    ShortcutManager(e);
});


document.onkeydown = function(e) {
	if(event.keyCode == 123) {
		return false;
	}
	if(e.altKey && e.keyCode == 'TAB'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'X'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'V'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'P'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'O'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'M'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
		return false;
	}
	if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
		return false;
	}
}
document.oncontextmenu = document.body.oncontextmenu = function() {return false;} 