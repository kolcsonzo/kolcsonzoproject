// táblázat számozás

getPagination('#table-id');
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	
// keresés a táblázatokban

	function myFunction() {
	 var input, filter, table, tr, i, txtValue;
	input = document.getElementById("keresoInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("table-id");
	tr = table.getElementsByTagName("tr");

	for (i = 1; i < tr.length; i++) {
		
	td = tr[i];
	
	if (td) {
	txtValue = (td.textContent || td.innerText);
	if (txtValue.toUpperCase().indexOf(filter) > -1) {
	tr[i].style.display = "";
	} else {
	tr[i].style.display = "none";
	}}}}