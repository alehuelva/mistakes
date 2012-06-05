<?php

namespace Mistakes\MistakesTestBundle;
//use Symfony\Component\DependencyInjection\SimpleXMLElement;



class loadxml{

 	protected $errors =array( ); //Array with errors
 	//protected $projectsname = array (); it isnt needed anymore
 
	public function loadProjects() { // Get projects from xml

		//$url = "http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff";
		//$xmlprojects = simplexml_load_file($url);
		$projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
		$xmlprojects = new \SimpleXMLElement($projectsfile);
		return $xmlprojects;
	}

	public function loadErrors($pageid = 0) { //get errors from xml of differents URL depending the attribute, return simplexmlElement if it exists, else 0
		$errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=" . $pageid);
		$xmlerrors = new \SimpleXMLElement($errorsfile);
		if ($xmlerrors->group) 
		 return $xmlerrors;
		else
		 return 0;	
	}


	public function resetErrors($xmlprojects) { //Reset the accounting of errors in the array before to be filled in and SET THE PROJECTNAME
		if ($xmlprojects != NULL){
			foreach ($xmlprojects->project as $proj) {
				$this->errors[(int)$proj->id] = array();
				$this->errors[(int)$proj->id]['cont']  = 0;
				$this->errors[(int)$proj->id]['name']  = (string)$proj->name;
				
			} 
		}else echo "Error loading errors";
	}



	/*public function setProjectname($xmlprojects){ //IT ISNT NEED IT, IT IS IN resetErrors
		if ($xmlprojects != NULL){
			foreach ($xmlprojects->project as $proj) {
			$this->projectsname[(int)$proj->id] = (string) $proj -> name;
			}
		} else echo "Error loading projects";
	}*/



	public function setErrors($xmlerrors) { //Count errors in the array errors
		if ($xmlerrors != NULL){
			foreach ($xmlerrors->group as $group) {
				$this->errors[(int)$group->{'project-id'}]['cont']++;	
			} 
		}else echo "Error loading errors";
	}



	public function getErrors(){ //Return array errors
		return $this->errors;
	}



	/*public function getProjectname(){  IT ISNT NEEDED
	return $this->projectsname;
	}*/

}