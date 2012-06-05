<?php

namespace Mistakes\MistakesTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Mistakes\MistakesTestBundle\loadxml;

use SaadTazi\GChartBundle\DataTable;
use SaadTazi\GChartBundle\Chart\PieChart;



class MistakesController extends Controller {

	//PROBANDO
	
	/*  /**
	 	* @Route("/mistakes", name="BloggerBundle_mistakes")
		* @Method({"GET"})
		*/
		public function indexAction()
		{
			$obj=new loadxml();
			$xmlprojects = $obj -> loadProjects();
			$obj -> resetErrors($xmlprojects);
			$page=0;
			$xmlerrors = 1;
			while ($xmlerrors) { 
			$xmlerrors = $obj ->  loadErrors($page);
			$obj -> setErrors($xmlerrors);
			$page++;}
			$temperror= ($obj -> getErrors());
			//$tempproj= ($obj -> getProjectname());
			
			
			 
			return $this->render('MistakesTestBundle:Mistakes:index.html.twig', array( //rendder the view
					'errors' => $temperror,
					//'projects' => $tempproj
			));
		
			
			//return new Response('<html><body>Hello</body></html>');
		}
	
	
		
		
		
		public function indexgrafAction()
		{
			$dataTable2 = new DataTable\DataTable();
			$dataTable2->addColumn('id1', 'prueba', 'string');
			$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'Errores', 'number'));
			
			$obj=new loadxml();
			$xmlprojects = $obj -> loadProjects();
			$obj -> resetErrors($xmlprojects);
			$page=0;
			$xmlerrors = 0;
				$xmlerrors = $obj ->  loadErrors($page);
				$obj -> setErrors($xmlerrors);
			$temperror= ($obj -> getErrors());
			
			foreach ($temperror as $error) {
				$dataTable2->addRow(array($error['name'], $error['cont']));
			}
	

			$temperror=1;
			 
			 //...
			//El caso es que hay que pasar los valores de la tabla, a los addRow, mirarlo manana bien; una vez seteada la tabla habria que recorrer la tabla para ir creando 
			//tablas con valor name y valor cont
			

        //simple cell (not an array)
        $dataTable2->addRow(array('row 1', 5));
        $dataTable2->addRow(array('row 2', 4));
        $dataTable2->addRow(array('row 3', 2));
        
			
			
			
			return $this->render('MistakesTestBundle:Mistakes:index.html.twig', array( //rendder the view
					'errors' => $temperror,

					'dataTable2' => $dataTable2->toArray(),

					
			));
		
				
			//return new Response('<html><body>Hello</body></html>');
		}
		

}







/*class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BloggerMistakesBundle:Default:index.html.twig');
    }
}*/
