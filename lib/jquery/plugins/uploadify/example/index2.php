<head>

<link href="css/default.css" rel="stylesheet" type="text/css" />
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/v2/extras/jQuery/jquery.js"></script>

<script type="text/javascript" src="scripts/swfobject.js"></script>


</head>
<body>
<input type="file" name="fileInput" id="fileInput" />
<script type="text/javascript">
$(document).ready(function() {
$('#fileInput').uploadify({
'uploader'  : 'uploadify.swf',
'script'    : 'uploadify.php',
'cancelImg' : 'cancel.png',
'auto'      : true,
'folder'    : 'uploads'
});
});
</script>

</body>
