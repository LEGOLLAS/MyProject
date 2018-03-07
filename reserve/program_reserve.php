<?php
	include_once("../include/db_conn.php");
	include_once("./_common.php");

	$g5['title'] = "예약신청";
	
	require_once(G5_THEME_PATH.'/head.php');
?>

<div style="padding-top:30px;">
	<div class="tbl_head01 tbl_wrap">
        <table>
        <caption>예약신청 목록</caption>
        <thead>
        <tr>
			<th scope="col">번호</th>
			<th scope="col">프로그램명</th>
			<th scope="col">대상</th>
			<th scope="col">정원</th>
			<th scope="col">이용료</th>
			<th scope="col"></th>
        </tr>
        </thead>
        <tbody>
		<?php
			$sql_count_sel = " SELECT count(*) cnt FROM program WHERE 1=1 ";
			
			if($searchSelect == "wrSubject") {
				$sql_count_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
			} else {
				$sql_count_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
			}

			$sql_count_sel .= " ORDER BY program_category_id ASC, program_sort ASC ";
			$count_result = mysqli_query($conn, $sql_count_sel);
			$count_row = mysqli_fetch_assoc($count_result);

			$total_cnt = $count_row['cnt'];

			$sql_sel = " SELECT * FROM program WHERE 1=1 ";
			
			if($searchSelect == "wrSubject") {
				$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
			} else {
				$sql_sel .= " AND wr_subject LIKE '%".$searchKeyword."%'";
			}
			
			$sql_sel .= " ORDER BY program_category_id ASC, program_sort ASC ";
			$result = mysqli_query($conn, $sql_sel);
			
			while($select_row = mysqli_fetch_array($result)) {
		?>
        <tr>
            <td class="td_num"><?=$total_cnt?></td>
			<td class="td_subject">
               <?=$select_row['wr_subject']?>
            </td>
            <td class="td_date"><?=$select_row['wr_1']?></td>
            <td class="td_mng"><?=$select_row['wr_6']?></td>
            <td class="td_board"><?=$select_row['wr_4']?></td>
            <td class="td_numbig">
                <input no="8" class="btn_submit get_content" type="button" value="예약신청" />
            </td>
        </tr>
        <?php
				$total_cnt--;
			}
		?>
        </tbody>
        </table>
    </div>
</div>

<?php
	include_once(G5_THEME_PATH.'/tail.php');
?>