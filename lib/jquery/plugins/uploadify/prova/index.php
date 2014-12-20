<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>JQuery File Upload Plugin Script - Demo - Uploadify</title>
<link rel="stylesheet" href="http://www.uploadify.com/wp-content/themes/uploadify2/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="/_scripts/jquery.js"></script>
<script type="text/javascript" src="/_scripts/swfobject.js"></script>
<script type="text/javascript" src="/_scripts/jquery.uploadify.v2.0.0.min.js"></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.uploadify.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.uploadify.com/wp-includes/wlwmanifest.xml" /> 
<link rel='index' title='Uploadify' href='http://www.uploadify.com' />
<meta name="generator" content="WordPress 2.8.3" />

<!-- begin WP sIFR -->
<link rel="stylesheet" href="http://www.uploadify.com/wp-content/plugins/wp-sifr/sifr/sifr.css" type="text/css" media="all" />
<script src="http://www.uploadify.com/wp-content/plugins/wp-sifr/sifr/sifr.js" type="text/javascript"></script>
<style type="text/css" media="screen">
	.sIFR-active h1,h2,h3 { visibility: hidden; }
</style>




</head>

<body id="page_">
<div id="container">
  <div id="header">
  	<div id="masthead"><a href="/"><img src="/_images/uploadify-logo.jpg" alt="uploadify - a multiple file upload plugin for jquery" width="560" height="90" border="0" /></a></div>

    <div id="navigation">
      <ul>
        <li><a id="navHome" href="/"><span>Home</span></a></li>
        <li><a id="navWhatIsIt" href="/what-is-it"><span>What Is It?</span></a></li>
        <li><a id="navDownload" href="/download"><span>Download</span></a></li>
        <li><a id="navDemo" href="/demo"><span>Demo</span></a></li>
        <li><a id="navImplementation" href="/implementation"><span>Implementation</span></a></li>

        <li><a id="navDocumentation" href="/documentation"><span>Documentation</span></a></li>
        <li><a id="navForum" href="/forum"><span>Forum</span></a></li>
      </ul>
    </div>		  </div>
  <div id="main">
    <div id="left">
      <h1>uploadify demos</h1>

<div class="demo">
<p><strong>Single File Upload</strong></p>
<input id="fileInput1" name="fileInput1" type="file" /> <a href="javascript:$('#fileInput1').uploadifyUpload();">Upload Files</a></div>
<div class="demo">
<p><strong>Multiple File Upload</strong></p>
<input id="fileInput2" name="fileInput2" type="file" /> <a href="javascript:$('#fileInput2').uploadifyUpload();">Upload Files</a> | <a href="javascript:$('#fileInput2').uploadifyClearQueue();">Clear Queue</a></div>
<div class="demo">
<p><strong>Single File Upload &#8211; Auto Start</strong></p>

<input id="fileInput3" name="fileInput3" type="file" /></div>
<div class="demo">
<p><strong>Single File Upload &#8211; Custom Button, Custom Queue</strong></p>
<div id="fileQueue" style="width:300px;height:250px;border:1px solid #E5E5E5;padding: 0;overflow:auto;margin-bottom: 10px;">&nbsp;</div>
<input id="fileInput4" name="fileInput4" type="file" /></div>
            <script type="text/javascript">
      $(document).ready(function() {
        	$("#fileInput1").uploadify({
		'uploader'       : '/_scripts/uploadify.swf',
		'script'         : '/_scripts/uploadify.php',
		'cancelImg'      : '/_images/cancel.png',
		'folder'         : '/_uploads',
		'multi'          : false
	});
	$("#fileInput2").uploadify({
		'uploader'       : '/_scripts/uploadify.swf',
		'script'         : '/_scripts/uploadify.php',
		'cancelImg'      : '/_images/cancel.png',
		'folder'         : '/_uploads',
		'multi'          : true
	});
	$("#fileInput3").uploadify({
		'uploader'       : '/_scripts/uploadify.swf',
		'script'         : '/_scripts/uploadify.php',
		'cancelImg'      : '/_images/cancel.png',
		'folder'         : '/_uploads',
		'auto'           : true,
		'multi'          : false
	});
	$("#fileInput4").uploadify({
		'uploader'       : '/_scripts/uploadify.swf',
		'script'         : '/_scripts/uploadify.php',
		'cancelImg'      : '/_images/cancel.png',
		'folder'         : '/_uploads',
		'buttonImg'      : '/_images/browse-files.png',
		'wmode'          : 'transparent',
		'width'          : 130,
		'queueID'        : 'fileQueue',
		'auto'           : true,
		'multi'          : true
	});      });
      </script>
            			<script type="text/javascript"><!--
			google_ad_client = "pub-3327366842184414";
			/* Uploadify Wide */
			google_ad_slot = "1666151590";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
			</script><br />
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>

    </div>
    <div id="right"><a href="/download"><img src="/_images/download-button.png" alt="Download the latest and greatest" width="250" height="73" border="0" /></a>
<form action="https://www.paypal.com/cgi-bin/webscr" class="donate" method="post">
  <h2>make a donation</h2>
  <p>Wait staff, bellhops, taxi drivers, and bathroom attendants get tips&mdash;coders don't.  Please donate.</p>
  <input type="hidden" name="cmd" value="_s-xclick" />
  <input type="hidden" name="hosted_button_id" value="3489472" />
  <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit2" alt="PayPal - The safer, easier way to pay online!" />

  <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</form>
<br />
<script type="text/javascript"><!--
google_ad_client = "pub-3327366842184414";
/* Uploadify */
google_ad_slot = "7754560632";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<h2>contributors</h2>
	<ul class='xoxo blogroll'>
<li><a href="http://www.benjarriola.com" title="SEO Specialist">Benj Arriola &#8211; SEO Specialist</a></li>
<li><a href="http://www.ronniesan.com" title="Optimized Web Design Services">RonnieSan &#8211; Optimized Web Design</a></li>

<li><a href="http://www.sulumitsretsambewblog.com" title="Sulumits Retsambew">Sulumits Retsambew</a></li>

	</ul>

</div>
    <div class="clear">&nbsp;</div>
  </div>
  <div><img src="/_images/footer.jpg" width="960" height="10" /></div>
    <div id="footer">&copy;2009 by Ronnie Garcia | <a href="http://www.ronniesan.com">Optimized Web Design</a></p></div>

</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-74181-8");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
