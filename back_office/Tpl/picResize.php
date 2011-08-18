

<?php include_once('header.php'); ?>


<?php /*<script type="text/javascript" src="./js/jquery_imgareaselect/scripts/jquery.min.js"></script>*/ ?>


<link rel="stylesheet" type="text/css" media="screen" href="./js/jquery_imgareaselect/css/imgareaselect-default.css" /> 
<script language="javascript" type="text/javascript" src="../js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="./js/jquery_imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>

<script type="text/javascript"> 
function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;
    
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;
 
    /*$('#preview img').css({
        width: Math.round(scaleX * 300),
        height: Math.round(scaleY * 300),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });*/
 
    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);    
}
 
$(function () {
    $('#photo').imgAreaSelect({ aspectRatio: '1:1', handles: true,
        fadeSpeed: 200, onSelectChange: preview });
});
</script> 


修改缩略图图片:<br />






<form action="pic.php?action=dothumbremake" method="post" style="margin:15px; clear:both;" enctype="multipart/form-data">

请点击以下图片进行选取区域:
<br />
<img src="/upload/<?php echo $_GET['url']; ?>" id="photo"/>


<br />

<input type="hidden" name="x1" value="" id="x1" />
<input type="hidden" name="y1" value="" id="y1" />
<input type="hidden" name="x2" value="" id="x2" />
<input type="hidden" name="y2" value="" id="y2" />
<input type="hidden" name="w" value="" id="w" />
<input type="hidden" name="h" value="" id="h" />

<input type="hidden" name="url" value="<?php echo $_GET['url']; ?>" />
<input type="submit" name="upload_thumbnail" value="保存缩略图" id="save_thumb" />

</form>

<script type="text/javascript"> 
$(document).ready(function () {
    $('img#photo').imgAreaSelect({
        handles: true,
		minHeight:72,
		minWidth:72,
    });
});
</script> 
</body>
</html>