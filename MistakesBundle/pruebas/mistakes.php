<?php 


class mistakes {
	
	public function getProjects() {
		$projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
		$xmlprojects = new SimpleXMLElement($projectsfile);
		return $xmlprojects;
	}
	
	
	
	public function getErrors($pageid=0) {
		$errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=" . $pageid);
		$xmlerrors = new SimpleXMLElement($errorsfile);
		return $xmlerrors;
	}
}

  public function count

 
$projects= array();
$projectsname = array ();

 
foreach ($xmlprojects->project as $proj) {
	$projects[(int)$proj->id] = 0;
	$projectsname[(int)$proj->id] = $proj -> name;
	//$projects[(int)$proj->id][$name] = (string)$proj->name;
	 
}
 
foreach ($xmlerrors->group as $group) {
	$projects[(int)$group -> {'project-id'}]++;
}var_dump ($projects);
 
 
 
echo '<table border="1">
<tr>
<th>name</th>
<th>number</th>
<th>cont</th>

</tr>';
foreach($projects as $proj => $cont){
	echo '<tr>
	<td>' . $projectsname[(int)$proj] . '</td>
	<td>' . $proj . '</td>
	<td>' . $cont . '</td>

	</tr>';
}