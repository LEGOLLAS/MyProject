<?

// 컨텐츠게시판에 wr_id 값이 있으면 컨텐츠 내용을 보여준다.
if ($bo_table == "contents_base" || $bo_table == "contents_edu" || $bo_table == "contents_study" || $bo_table == "contents_culture") {	
	$contSQL = " select wr_id, wr_subject, wr_content from g4_write_{$bo_table} where wr_id = '{$wr_id}'  limit 0, 1";
	$contRow = sql_fetch($contSQL);
	echo $contRow[wr_content];

	if ($is_admin) {					// 최고관리자에게만 수정버튼을 보여준다.
?>
		<div style='text-align:right;'>
			<input type="button" name="btnContEdit" value="  수  정  " onclick="editWindow('<?=$bo_table;?>','<?=$wr_id;?>');">
		</div>
<?
	}

} else {
	if ($bo_table) {		// 게시판
		$iframeURL = "/board/bbs/board.php?bo_table=" . $bo_table;

		if (strlen($wr_id) > 0) {		// 게시판을 iframe 으로 불러올때
			$iframeURL .= "&wr_id=" . $wr_id;
		}
		
		if (strlen($sca) > 0) {		// 분류가 있으면 분류도 같이 넘겨준다.
			$iframeURL .= "&sca=" . urlencode($sca);
		}
		
		if (strlen($mode) > 0) {		// 구분값이 있을때
			$iframeURL .="&mode=" . $mode;
		}
	}
	
	if ($iframeURL) {		// 컨텐츠/게시판이 아니고, 해당 URL 를 iframe 으로 불러올때
?>
		<iframe src="<?=$iframeURL;?>" title="<?=$title?>" frameborder="0" scrolling="no" width="100%"  name="viewFrame" id="viewFrame" onload="resizeIfr(this,500);"></iframe>
<?
	}

} 
?>