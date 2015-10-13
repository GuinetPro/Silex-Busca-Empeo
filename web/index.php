<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/Classes/PHPExcel.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\Validator\Constraints as Assert;

$app = new Silex\Application();



$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array( 'twig.path' => __DIR__.'/views',));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	'locale'            => 'es',
    'locale_fallbacks' => array('es'),
));





$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'     => 'pdo_mysql',
        'host'       =>'localhost',
        'dbname'     => '',
        'charset'    => 'utf8',
        'password'   => ''
    ),
));


$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
});




$app->match('/', function (Request $request) use ($app) {



	$form = $app['form.factory']->createBuilder('form')
	    ->add('nombre',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))

	    ->add('apellido',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))

	    ->add('fecha_nacimiento',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control date-picker')
	    ))

	    ->add('rut',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))

	    ->add('comuna',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))

	    ->add('telefono',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))
	    ->add('celular',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))

	    ->add('email', 'text', array(
	        'constraints' => new Assert\Email(),
	        'attr' => array('class' => 'form-control', 'placeholder' => 'Your@email.com')
	    ))

	    ->add('codigo',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))



	    ->add('tiempo_exp',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 1))),
	        		'attr' => array('class' => 'form-control numero')
	    ))



	    ->add('formacion_academica',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control')
	    ))



	    ->add('pretension_renta',
	    	 'text', array(
	        		'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
	        		'attr' => array('class' => 'form-control numero')
	    ))




	    ->getForm();



    $form->handleRequest($request);

    if ($form->isValid()) {

        $data = $form->getData();

		$app['db']->insert('profesionales', array(

		    'nombre' 				=> $app->escape($data['nombre']),
			'apellido' 				=> $app->escape($data['apellido']),
			'fecha_nacimiento' 		=> $app->escape($data['fecha_nacimiento']),
			'rut' 					=> $data['rut'],
			'comuna' 				=> $app->escape($data['comuna']),
			'telefono' 				=> $app->escape($data['telefono']),
			'celular' 				=> $app->escape($data['celular']),
			'email' 				=> $data['email'],
			'codigo' 				=> $app->escape($data['codigo']),
			'tiempo_exp' 			=> $app->escape($data['tiempo_exp']),
			'formacion_academica' 	=> $app->escape($data['formacion_academica']),
			'pretension_renta' 		=> $app->escape($data['pretension_renta']),
			'created_at' 			=> date("Y-m-d H:i:s"),
			'updated_at' 			=> date("Y-m-d H:i:s")


		));

		return $app->redirect('success');


    }
 // display the form
    return $app['twig']->render('index.twig', array('form' => $form->createView()));
});

$app->get('/success', function () use ($app) {

	$objPHPExcel = new PHPExcel();

		$estiloTituloReporte = array(
			    'font' => array(
			        'name'      => 'Verdana',
			        'bold'      => true,
			        'italic'    => false,
			        'strike'    => false,
			        'size' =>16,
			        'color'     => array(
			            'rgb' => 'FFFFFF'
			        )
			    ),
			    'fill' => array(
			        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			        'color' => array(
			            'argb' => 'FF220835')
			    ),
			    'borders' => array(
			        'allborders' => array(
			            'style' => PHPExcel_Style_Border::BORDER_NONE
			        )
			    ),
			    'alignment' => array(
			        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        'rotation' => 0,
			        'wrap' => TRUE
			    )
			);

		$estiloTituloColumnas = array(
			    'font' => array(
			        'name'  => 'Arial',
			        'bold'  => true,
			        'color' => array(
			            'rgb' => '000000'
			        )
			    ),
			    'fill' => array(
			        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			    'rotation'   => 90,
			        'startcolor' => array(
			            'rgb' => 'c47cf2'
			        ),
			        'endcolor' => array(
			            'argb' => 'FF431a5d'
			        )
			    ),
			    'borders' => array(
			        'top' => array(
			            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
			            'color' => array(
			                'rgb' => '143860'
			            )
			        ),
			        'bottom' => array(
			            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
			            'color' => array(
			                'rgb' => '143860'
			            )
			        )
			    ),
			    'alignment' =>  array(
			        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        'wrap'      => TRUE
			    )
			);

		$estiloInformacion = new PHPExcel_Style();

		$estiloInformacion->applyFromArray( array(
			    'font' => array(
			        'name'  => 'Arial',
			        'color' => array(
			            'rgb' => '000000'
			        )
			    ),
			    'fill' => array(
			    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			    'color' => array(
			            'argb' => 'FFd9b7f4')
			    ),
			    'borders' => array(
			        'left' => array(
			            'style' => PHPExcel_Style_Border::BORDER_THIN ,
			        'color' => array(
			                'rgb' => '3a2a47'
			            )
			        )
			    )
		));


	$sql = "SELECT * FROM profesionales";
    $post = $app['db']->fetchAll($sql);



	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("profesionales");

	$objPHPExcel->setActiveSheetIndex()->mergeCells('A1:L1');

	$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);

	$objPHPExcel->getActiveSheet(0)->getStyle('A1:L1')->getFont()->setSize('15') ;

	$objPHPExcel->setActiveSheetIndex()
						    ->setCellValue('A1','Datos Profesionales')
						    ->setCellValue('A3',  'Nombre')
						    ->setCellValue('B3',  'Apellido')
						    ->setCellValue('C3',  'Fecha Nacimiento')
						    ->setCellValue('D3',  'Rut')
						    ->setCellValue('E3',  'Comuna')
						    ->setCellValue('F3',  'Telefono')
						    ->setCellValue('G3',  'Celular')
						    ->setCellValue('H3',  'Email')
						    ->setCellValue('I3',  'Codigo')
						    ->setCellValue('J3',  'Años experienci')
						    ->setCellValue('K3',  'Formación Académica')
						    ->setCellValue('L3',  'Pretensiones de renta liquida')
;

	$c = 4;

	foreach ($post as $p) {

		$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$c, $p['nombre']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$c, $p['apellido']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$c, $p['fecha_nacimiento']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$c, $p['rut']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$c, $p['comuna']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$c, $p['telefono']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$c, $p['celular']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$c, $p['email']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$c, $p['codigo']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$c, $p['tiempo_exp']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$c, $p['formacion_academica']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$c, $p['pretension_renta']);


		$c++;

	}


	$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('A')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('K')->setAutoSize(TRUE);
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('L')->setAutoSize(TRUE);


	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="Profesionales_'.time().'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;


      return $app['twig']->render('success.twig');
});
$app->run();
