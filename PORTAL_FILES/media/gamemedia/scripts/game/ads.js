function adBlockDetected() {
	var r=new XMLHttpRequest();
	r.open('POST','https://play.warofgalaxyz.com/game.php?page=overview');
	r.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	r.send('blockingAds=Yes');
	console.log('Displaying Ads: No');
}

function adBlockNotDetected() {
	var r=new XMLHttpRequest();
	r.open('POST','https://play.warofgalaxyz.com/game.php?page=overview');
	r.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	r.send('blockingAds=No');
	console.log('Displaying Ads: Yes');
}


adblock = false;
