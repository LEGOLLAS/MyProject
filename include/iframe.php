<?

// �������Խ��ǿ� wr_id ���� ������ ������ ������ �����ش�.
if ($bo_table == "contents_base" || $bo_table == "contents_edu" || $bo_table == "contents_study" || $bo_table == "contents_culture") {	
	$contSQL = " select wr_id, wr_subject, wr_content from g4_write_{$bo_table} where wr_id = '{$wr_id}'  limit 0, 1";
	$contRow = sql_fetch($contSQL);
	echo $contRow[wr_content];

	if ($is_admin) {					// �ְ�����ڿ��Ը� ������ư�� �����ش�.
?>
		<div style='text-align:right;'>
			<input type="button" name="btnContEdit" value="  ��  ��  " onclick="editWindow('<?=$bo_table;?>','<?=$wr_id;?>');">
		</div>
<?
	}

} else {
	if ($bo_table) {		// �Խ���
		$iframeURL = "/board/bbs/board.php?bo_table=" . $bo_table;

		if (strlen($wr_id) > 0) {		// �Խ����� iframe ���� �ҷ��ö�
			$iframeURL .= "&wr_id=" . $wr_id;
		}
		
		if (strlen($sca) > 0) {		// �з��� ������ �з��� ���� �Ѱ��ش�.
			$iframeURL .= "&sca=" . urlencode($sca);
		}
		
		if (strlen($mode) > 0) {		// ���а��� ������
			$iframeURL .="&mode=" . $mode;
		}
	}
	
	if ($iframeURL) {		// ������/�Խ����� �ƴϰ�, �ش� URL �� iframe ���� �ҷ��ö�
?>
		<iframe src="<?=$iframeURL;?>" title="<?=$title?>" frameborder="0" scrolling="no" width="100%"  name="viewFrame" id="viewFrame" onload="resizeIfr(this,500);"></iframe>
<?
	}

} 
?>