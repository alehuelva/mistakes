<?php

namespace Mistakes\MistakesTestBundle;
//use Symfony\Component\DependencyInjection\SimpleXMLElement;

class LoadXml
{
 	protected $errors = array();    //** Array with errors
	
	public function loadProjects()  //** Get projects from xml
	{ 
	//$url = "http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff";
	//$xmlprojects = simplexml_load_file($url);
	$projectsfile = file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=808b45ec1d7854563c3bb2fab160e5b90f5e1ae3");
	$xmlprojects = new \SimpleXMLElement($projectsfile);
	
	return $xmlprojects;
	}

	public function loadErrors($pageid = 0)   //** Get errors from xml of differents URL depending the attribute, return simplexmlElement if it exists, else 0
	{ 
		$errorsfile = file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=808b45ec1d7854563c3bb2fab160e5b90f5e1ae3&page=" . $pageid);
		$xmlerrors = new \SimpleXMLElement($errorsfile);
		if ($xmlerrors->group) {    //** If XML is not empty.
			
			return $xmlerrors;
		
		} 
		else {
		 return 0;
		}	
	}
	
	public function resetErrors($xmlprojects)   //** Reset the accounting of errors in the array before to be filled in and set the projectname
	{ 
		if ($xmlprojects != NULL) {
			foreach ($xmlprojects->project as $proj) {
				$this->errors[(int)$proj->id] = array();
				$this->errors[(int)$proj->id]['cont'] = 0;
				$this->errors[(int)$proj->id]['name'] = (string)$proj->name;	
			} 
		}
		else {
			echo "Error loading errors";
		}
	}

	public function setErrors($xmlerrors)  //** Count errors in the array errors
	{ 
		if ($xmlerrors != NULL){
			foreach ($xmlerrors->group as $group) {
				$this->errors[(int)$group->{'project-id'}]['cont']++;	
			} 
		} 		//** else echo "Error2 loading errors"; It's not useful cause loadErrors() always will return 0 in the last xml
	}      


	public function getErrors()    //**Return array errors
	{ 
		return $this->errors;
	}
}