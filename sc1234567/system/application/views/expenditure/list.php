<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."expenditure/export' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span id = 'id1' ><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='view_data();' >";
echo "<span id = 'id2' ><img src='".$url."images/view.gif' border='0' /></span>";
echo "<span>  View  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a  onClick='addnew_data();'>";
echo "<span id = 'id3' ><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$currentAcademicYear = $yno->AcademicYear;
	}
}




echo "<div class = 'showboxa' >";
echo "<select name = 'Year' id = 'Year' style='width: 100px;' onchange = 'get_list();' >";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	if($this->session->userdata('yearcf') == $ys->AcademicYear){
		echo "<option value = '".$ys->AcademicYear."' selected = 'selected'>".$ys->AcademicYear."</option>";
	}else{
		echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
	}	
}
echo "</select>";
echo "</div>";



echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "8" id = "table_title">Expenditure List View </th></tr>';
echo "<tr>";
echo "<th align='center' >S.No.</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='expenditure' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Expenditure Type<a class = 'LibraryNo' onClick='sort_fun(this);' >";
echo "<th align='center' >Bill No</th>";
echo "<th align='center' >Bill Amount</th>";
echo "<th align='center' >Bill Date</th>";
echo "<th align='center' >Spent By</th>";
echo "<th align='center' >Justification</th>";
echo "</tr>";
$i = 1;
//var_dump($result);
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{
foreach (array_reverse($result) as $row){
$BillDate=date("d-m-Y", strtotime($row->BillDate));
echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'ExpenditureId' id = 'ExpenditureId' value ='" . $row->ExpenditureId. "'/></td>";
echo "<td align='center'>"; 
foreach ($expendituretype as $rowb){
	if($row->ExpenditureTypeId == $rowb->ExpenditureTypeId){
		 echo $rowb->ExpenditureType;
	}
	
}
echo "</td>";
echo "<td align='center'>" . $row->BillNo . "</td>";
echo "<td align='center'>" . $row->BillAmount . "</td>";
echo "<td align='center'>" . $BillDate . "</td>";
echo "<td align='center'>" . $row->SpentBy. "</td>";
echo "<td align='center'>" . $row->Justification. "</td>";

echo "</tr>";

}
}
//else part ends here
echo "</table>";
//echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
echo "<input type = 'hidden' name = 'currentAcademicYear' id='currentAcademicYear' value = '". $currentAcademicYear ."' /> </th>";
?>
<script>
function edit_data(){
   var year = $('#Year').val();
   var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id1').disabled = true;
	}
	else{
    var rollid = $('input:radio[name=ExpenditureId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>expenditure/edit/'+rollid;
	}
	}
}	
function view_data(){
   var year = $('#Year').val();
  var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id2').disabled = true;
	}
	else{
	var rollid = $('input:radio[name=ExpenditureId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>expenditure/view/'+rollid;
	}
	}
}	

function addnew_data(){	
    var year = $('#Year').val();
    var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id3').disabled = true;
	}
	else{
	window.location='<?=$url?>expenditure/addnew/';
	}
	
}	
function get_list(){
	var year = $('#Year').val();
	window.location='<?=$url?>expenditure/listview/'+year;
		
}	

</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>
