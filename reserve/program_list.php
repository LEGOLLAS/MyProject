<?php
	include_once("../include/db_conn.php");
	include_once("./_common.php");

	$g5['title'] = "예약신청";
	
	require_once(G5_THEME_PATH.'/head.php');
?>

<style>
.tbl_head01 table th {
	font-size: 13px;
	letter-spacing:0px !important;
}
</style>

<div style="padding-top:30px;">
	<div class="tbl_head01 tbl_wrap">
        <table>
        <caption>예약신청 목록</caption>
        <thead>
        <tr>
			<th scope="col">프로그램명</th>
			<th scope="col">신청자수</th>
			<th scope="col">프로그램금액</th>
			<th scope="col">운영일</th>
			<th scope="col"></th>
        </tr>
        </thead>
        <tbody>
		<?php
			$sql_count_sel = " SELECT count(*) cnt FROM rev_program_admin WHERE 1=1 ";
			$count_result = mysqli_query($conn, $sql_count_sel);
			$count_row = mysqli_fetch_assoc($count_result);

			$total_cnt = $count_row['cnt'];

			$sql_sel = " SELECT * FROM rev_program_admin WHERE 1=1  ";
			$result = mysqli_query($conn, $sql_sel);
			
			while($select_row = mysqli_fetch_array($result)) {
				/*
				$program_category_query = "SELECT * FROM program_category WHERE category_id = '".$select_row['program_category_id']."'";
				$program_category_result = mysqli_query($conn, $program_category_query);
				$program_category_row = mysqli_fetch_assoc($program_category_result);
				
				$program_manage_admin_query = "SELECT manage_name FROM program_manage_admin WHERE manage_id = '".$select_row['program_manage_id']."'";
				$program_manage_admin_result = mysqli_query($conn, $program_manage_admin_query);
				$program_manage_admin_row = mysqli_fetch_assoc($program_manage_admin_result);
				*/
		?>
        <tr>
			<td class="td_subject">
               <?=$select_row['program_name']?>
            </td>
            <td class="td_date"><?=$select_row['people_cnt']?></td>
            <td class="td_board"><?=$select_row['program_price']?></td>
            <td class="td_board"><?=$select_row['admin_start_date']?> ~ <?=$select_row['admin_end_date']?></td>
            <td class="td_numbig">
			<? if($member['mb_id'] == "") {?>
                <input class="btn_submit get_content" type="button" value="예약신청" onclick="javascript:alert('로그인하셔야 합니다.');location.href = '/bbs/login.php?url=/reserve/program_list.php';" />
			<? } else { ?>
				<input class="btn_submit get_content" type="button" value="예약신청" onclick="location.href = '/reserve/program_reserve01.php?program_id=<?=$select_row['wr_id']?>';" />
			<? } ?>
            </td>
        </tr>
        <?php
			}
		?>
        </tbody>
        </table>
    </div>
</div>

<?php
	include_once(G5_THEME_PATH.'/tail.php');
?>