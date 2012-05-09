<?php 


class mistakes {
	
	public $projects= array(); //CAMBIAR ESTO no son public
	public $projectsname = array ();
	
	
	public function loadProjects() { // Get projects from xml
		$projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
		$xmlprojects = new SimpleXMLElement($projectsfile);
		return $xmlprojects;
	}

	
	public function loadErrors($pageid=0) { //get errors from xml
		$errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=" . $pageid);
		$xmlerrors = new SimpleXMLElement($errorsfile);
		return $xmlerrors;
	}
	
	public function resetErrors($xmlprojects) { //Reset the accounting of errors in the array
		if ($xmlprojects != NULL){
			foreach ($xmlprojects->project as $proj) {
				$projects[(int)$proj->id] = 0;
				$projectsname[(int)$proj->id] = $proj -> name;
			}
		} else echo "Error loading projects";
		
		//return ?
		}

  	public function getErrors($xmlerrors) {
			if ($xmlerrors != NULL){
				foreach ($xmlerrors->group as $group) {
				$projects[(int)$group -> {'project-id'}]++;
				}
			}else echo "Error al cargar proyectos";
  	}
 
 
 
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
  }
}