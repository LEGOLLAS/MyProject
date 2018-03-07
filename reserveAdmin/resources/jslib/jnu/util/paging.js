/*var page_index = 1;
var record_count_per_page = 2;
var paging_pre = '<button type="button" onclick="go_page(\'paging_pre\');">pre</button>';
var paging_next = '<button type="button" onclick="go_page(\'paging_next\');">next</button>';
var paging_start_index = 1;
var paging_size = 5;
var paging_total_count = 5;
var paging_total_page_count = 2;*/

paging = function(){
	var html = "";

	if ( paging_total_count > 0 ){
		html += paging_pre;

		paging_total_page_count = paging_total_count/record_count_per_page;

		if ( paging_total_count%record_count_per_page > 0 ){
			paging_total_page_count++;
			paging_total_page_count = Math.floor(paging_total_page_count);
		}

		var last = 0;

		if ( paging_start_index+paging_size > paging_total_page_count ){
			last = paging_total_page_count;
		}
		else{
			last = paging_start_index+paging_size-1;
		}

		for ( var i=paging_start_index; i<=last; i++ ){
			if ( i == page_index ){
				html += '<a onclick="go_page('+i+'); return false;" class="on">'+i+'</a>';
			}
			else{
				html += '<a onclick="go_page('+i+'); return false;">'+i+'</a>';
			}
		}

		html += paging_next;
	}
	$('#paging').html(html);
};

paging_chk = function(page){

	var result = true;

	if ( page == 'paging_pre' ){
		if ( page_index == 1 ){
			alert('이전페이지가 없습니다.');
			result = false;
		}
		else{
			//paging_start_index = paging_start_index - paging_size;
			//page_index = paging_start_index;
			if( paging_start_index == page_index ){
				paging_start_index = paging_start_index - 5;
			}
			page_index --;
		}

	}
	else if ( page == 'paging_next' ){

		if ( page_index >= paging_total_page_count ){
			alert('다음페이지가 없습니다.');
			result = false;
		}
		else{
			//paging_start_index = paging_start_index + paging_size;
			//page_index = paging_start_index;

			if( page_index%5 == 0 ){
				paging_start_index = paging_start_index + 5;
			}
			page_index ++;
		}
	}
	else{
		page_index = page;
	}
	return result;
};