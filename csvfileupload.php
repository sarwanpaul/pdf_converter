 <style type="text/css">
	.csvTable tr td{white-space: nowrap}
	/*  .csvTable tr:nth-child(even) {background: #CCC;font-size:12px;color:black;}
		.csvTable tr:nth-child(odd) {background: #FFF;font-size:12px;color:black;}  */
	table { border:1px solid #ccc; border-collapse:collapse; padding:5px; }	
th { background:#eff5fc; padding:10px; text-align:center; }	
td { padding:10px; }
</style>
 <h2>Excel File Data Please Check:</h2>
 <form name="pdf_convert" method="POST" action="create_pdf.php">
 <?php
if (isset($_FILES['csv_file']) && $_FILES['csv_file']['size'] > 0) 
{
	$row = 0;	
		if (($handle = fopen($_FILES['csv_file']['tmp_name'], "r")) !== FALSE) 
		{
			echo "<table class='csvTable' border='1'>\n<thead>";
		
			while (($data = fgetcsv($handle, 0, ",")) !== FALSE) 
			{
				
				$num = count($data);
				if($row ==0) //Header rows
				{
					foreach ($data as $key => $value) {
						echo "<input type='hidden' value='".$value."' name='heading[]'>";
					}
					for ($c=0; $c < $num; $c++)
					{
						echo "<th>".$data[$c] . "&nbsp;</th>";
					}
				}
				else
				{
					// Change the below line according to your csv file
					foreach ($data as $key => $value) {
						echo "<input type='hidden' value='".$value."' name='check1[]'>";
					}
					echo "<tr>";
					for ($c=0; $c < $num; $c++)
						echo "<td>".$data[$c] . "&nbsp;</td>";
					echo'</tr>';
				}
	$row++;
	
					if($row==4)
						echo "\n</thead>\n<tbody>";
					
			}
			echo '</tbody></table>';	
			fclose($handle);
		}else
			echo 'Can not open file: '.$_FILES['csv_file']; 
}else
echo 'NO File selected';
 ?>
  <input type="submit" name="submit" value="Download PDF" />
 </form>
