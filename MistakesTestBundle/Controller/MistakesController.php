<?php

namespace Mistakes\MistakesTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Mistakes\MistakesTestBundle\loadxml;
use Mistakes\MistakesTestBundle\Entity\Error;


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
			
			 //Load errors in array $temperror and keep them in database
			$xmlerrors = 1;
			while ($xmlerrors) { 
			$xmlerrors = $obj ->  loadErrors($page);
			$obj -> setErrors($xmlerrors);
			$page++;}
			$temperror= ($obj -> getErrors());

			//keep in database
			foreach ($temperror as $key => $error){
			$prueba=0;
			$em = $this->getDoctrine()->getEntityManager();
			$prueba = $em->getRepository('MistakesTestBundle:Error')->findOneByName($error['name']);
			
			if (!$prueba){      //CREATE
				$errordoctr = new Error();
				$errordoctr->setAbId($key);
				$errordoctr->setName($error['name']);
				$errordoctr->setCont($error['cont']);
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($errordoctr);
			}
			 else{              //UPDATE
			 	$conttemp = $prueba->getCont();
			 	if ($error['cont'] != $conttemp){
				$prueba->setCont($error['cont']);
			  }
			 }
			}$em->flush();
			
			/* DELETE DATABASE
			$repository = $this->getDoctrine()
			->getRepository('MistakesTestBundle:Error');
			$temperror = $repository->findAll();
			$em = $this->getDoctrine()->getEntityManager();
			$query = $em->createQuery(
					'DELETE MistakesTestBundle:Error'
			);
			$errors = $query->getResult();
			//var_dump($errors);die();
			//$em->persist($errors);
			//$em->flush();
			*/
			
			
			//Crete an array $temperror containing the database
			$repository = $this->getDoctrine()
			->getRepository('MistakesTestBundle:Error');
			$temperror = $repository->findAll();
			//var_dump($temperror);die();
			$dataTable2 = new DataTable\DataTable();
			$dataTable2->addColumn('id1', 'prueba', 'string');
			$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'Errores', 'number'));
			
			foreach ($temperror as $tablaerror)
			$dataTable2->addRow(array($tablaerror->getName(), $tablaerror->getCont()));
			 
			return $this->render('MistakesTestBundle:Mistakes:index.html.twig', array( //rendder the view
					'errors' => $temperror,
					'dataTable2' => $dataTable2->toArray()
			));
		
			
		}
	
		
		public function indexgrafAction()
		{
			$dataTable2 = new DataTable\DataTable();
			$dataTable2->addColumn('id1', 'prueba', 'string');
			$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'Errores', 'number'));
			/*
			$obj=new loadxml();
			$xmlprojects = $obj -> loadProjects();
			$obj -> resetErrors($xmlprojects);
			$page=0;
			$xmlerrors = 1;
			//while ($xmlerrors) { 
			$xmlerrors = $obj ->  loadErrors($page);
			$obj -> setErrors($xmlerrors);
			//$page++;}
			$temperror= ($obj -> getErrors());
			
			foreach ($temperror as $error) {
				$dataTable2->addRow(array($error['name'], $error['cont']));
			}
	

			$temperror=1;*/
			 
			 //...
			//El caso es que hay que pasar los valores de la tabla, a los addRow, mirarlo manana bien; una vez seteada la tabla habria que recorrer la tabla para ir creando 
			//tablas con valor name y valor cont
			

        //simple cell (not an array)
        $dataTable2->addRow(array('row 1', 5));
        $dataTable2->addRow(array('row 2', 4));
        $dataTable2->addRow(array('row 3', 2));
        
			
			
			
			return $this->render('MistakesTestBundle:Mistakes:index.html.twig', array( //rendder the view
					//'errors' => $temperror,

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
