<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<a class="ahref_data" href="#" onclick="javascript:input_data();return false;"><i class="material-icons">&#xE147;</i>Tambah</a>
<a class="ahref_data" href="#" onclick="javascript:open_search();return false;" id="tombol_open_search_form"><i class="material-icons">&#xE8B6;</i>Search</a>
<div id="formSearch">
    <form id="pencarian" method="post">
    <label>Kata Kunci</label> 
    <input type="text" class="form-control" id="searchKeyword" name="searchKeyword"/>
    <br />
    <a class="ahref_data" href="#" onclick="javascript:$('#formSearch').dialog('close');return false;"><i class="material-icons">&#xE14C;</i>Close</a>
    <a class="ahref_data" href="#" onclick="javascript:searchTable();return false;"><i class="material-icons">&#xE8B6;</i>Search</a>
    </form>
</div>
<br style="clear:both;" />
<table id="tableData" style="display:none;"></table>
<?php echo $insert_view; ?>
