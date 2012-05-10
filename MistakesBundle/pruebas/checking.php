<?php
namespace Mistakes\MistakesBundle\pruebas;



  	$obj= new Mistakes();
  	
  	$xmlprojects = $obj -> loadProjects();
  	$xmlerrors = $obj ->  loadErrors(10);
  	$obj -> resetErrors($xmlprojects); 
  	$obj -> setErrors($xmlerrors); 
  	$obj -> setProjectname($xmlprojects);
    $temperror= ($obj -> getErrors());  
    $tempproj= ($obj -> getProjectname()); 

  	
  	
  	
  	echo '<table border="1">
  	<tr>
  	<th>name</th>
  	<th>number</th>
  	<th>cont</th>
  	
  	</tr>';
  	foreach($temperror as $proj => $cont){
  		echo '<tr>
  		<td>' . $tempproj[(int)$proj] . '</td>
  		<td>' . $proj . '</td>
  		<td>' . $cont . '</td>
  	
  		</tr>';
  	}
  	echo '</table>';



