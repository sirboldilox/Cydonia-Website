<?php // Footer content and html closing tags.


// Stat Counter


echo <<<_END

<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=8763549;
var sc_invisible=1;
var sc_security="63314664";
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/8763549/0/63314664/1/"
alt="web analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

_END;


// Close Container Div, Body, HTML tags.
echo "</div></body></html>";

// Close MySQL connection
mysql_close($mysqlcon);
?>
