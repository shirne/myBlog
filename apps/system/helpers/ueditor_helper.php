<?php
#doc
#    function:    create_editor
#    scope:        PUBLIC
#
#/doc

if(!function_exists('create_editor')){
    function create_editor($globalname='editor',$ta='content',$fm='edit',$type='full'){
		static $ueditor_init=FALSE;
        $editor  = array();
		if(!$ueditor_init){
			$editor[]='<script type="text/javascript">';
			$editor[]='$(\'<link rel="stylesheet" type="text/css" href="'.ROOT.'libs/ueditor/themes/default/ueditor.css" />\').appendTo($("head"))';
			$editor[]='window.UEDITOR_HOME_URL="'.ROOT.'libs/ueditor/";';
			$editor[]="window.UEDITOR_CONFIG_TB = {
				'full':[['FullScreen', 'Source', '|', 'Undo', 'Redo', '|', 'Bold', 'Italic', 'Underline', 'StrikeThrough', 'Superscript', 'Subscript', 'RemoveFormat', 'FormatMatch','AutoTypeSet', '|', 'BlockQuote', '|', 'PastePlain', '|', 'ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList','SelectAll', 'ClearDoc', '|', 'CustomStyle', 'Paragraph', '|','RowSpacingTop', 'RowSpacingBottom','LineHeight', '|','FontFamily', 'FontSize', '|', 'DirectionalityLtr', 'DirectionalityRtl', '|', '', 'Indent', '|', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyJustify', '|', 'Link', 'Unlink', 'Anchor', '|', 'ImageNone', 'ImageLeft', 'ImageRight', 'ImageCenter', '|', 'InsertImage', 'Emotion', 'InsertVideo', 'Attachment', 'Map', 'GMap', 'PageBreak', 'HighlightCode', '|', 'Horizontal', 'Date', 'Time', 'Spechars','WordImage', '|', 'InsertTable', 'DeleteTable', 'InsertParagraphBeforeTable', 'InsertRow', 'DeleteRow', 'InsertCol', 'DeleteCol', 'MergeCells', 'MergeRight', 'MergeDown', 'SplittoCells', 'SplittoRows', 'SplittoCols', '|', 'Print', 'Preview', 'SearchReplace','Help']],
				'normal':[['FullScreen', 'Source', '|', 'Undo', 'Redo', '|', 'Bold', 'Italic', 'Underline', 'StrikeThrough', 'Superscript', 'Subscript', 'RemoveFormat', 'FormatMatch','AutoTypeSet', '|', 'BlockQuote', 'PastePlain', '|', 'ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList','SelectAll', 'ClearDoc', '|', 'CustomStyle', 'Paragraph', '|','RowSpacingTop', 'RowSpacingBottom','LineHeight', '|','FontFamily', 'FontSize','Indent', '|', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyJustify', '|', 'Link', 'Unlink', 'Anchor', '|', 'ImageNone', 'ImageLeft', 'ImageRight', 'ImageCenter', '|', 'InsertImage', 'Emotion', 'HighlightCode', '|', 'Date', 'Time', 'Spechars','|', 'InsertTable', 'DeleteTable', 'InsertParagraphBeforeTable', 'InsertRow', 'DeleteRow', 'InsertCol', 'DeleteCol', 'MergeCells', 'MergeRight', 'MergeDown', 'SplittoCells', 'SplittoRows', 'SplittoCols', '|', 'Help']],
				'simple':[['FullScreen', 'Source', '|', 'Bold', 'Italic', 'Underline', 'StrikeThrough', 'Superscript', 'Subscript', 'RemoveFormat', 'FormatMatch','AutoTypeSet', '|', 'PastePlain', 'ForeColor', 'BackColor', 'InsertOrderedList', 'InsertUnorderedList','SelectAll', 'ClearDoc', '|', 'CustomStyle', 'Paragraph','LineHeight', '|','FontFamily', 'FontSize', '|','Indent', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyJustify', '|', 'Link', 'Unlink', 'Anchor', 'Emotion', 'Date', 'Time', 'Help']]
				}";
			$editor[]='</script>';
			$editor[]='<script type="text/javascript" src="/libs/ueditor/editor_config.js"></script>';
			$editor[]='<script type="text/javascript" src="/libs/ueditor/editor_all_min.js"></script>';
			$ueditor_init = TRUE;
		}
        $editor[]='<script type="text/javascript">';
        $editor[]='jQuery(function($){
	var config={
            imagePath:"'.UPLOAD_PATH.'editor/",
            imageUpload:"'.site_url('system/imageupload').'",
            filePath:"'.UPLOAD_PATH.'attachment/",
            fileUpload:"'.site_url('system/fileupload').'",
            catcherUrl:"'.site_url('system/remote').'",
            localDomain:"'.$_SERVER['SERVER_NAME'].'",
            imageManagerPath:"'.site_url('system/imageview').'",
            snapscreenHost:"'.$_SERVER['SERVER_NAME'].'",
            snapscreenServerFile:"'.site_url('system/snapimgup').'",
            pageBreakTag:"[page_break]",
			emotionLocalization:"'.ROOT.'resource/emotion/",
            toolbars:window.UEDITOR_CONFIG_TB.'.$type.'
        };';
        $editor[]='
        window.'.$globalname.'=new baidu.editor.ui.Editor(config);
        window.'.$globalname.'.render(document.'.$fm.'.'.$ta.');
    })';
        $editor[]='</script>';
        
        return implode("\n",$editor);
    }
}


/*End file of Ueditor.php*/
