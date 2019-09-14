<?php

use yii\helpers\Html;
use yii\helpers\Url;

// Creando Nuevo documento
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Agregando una sección vacía
$section = $phpWord->addSection();


$section->addText( 'PROYECTO
FORTALECIMIENTO DE LAS COMPETENCIAS BÁSICAS DE ESTUDIANTES DE LAS INSTITUCIONES EDUCATIVAS OFICIALES DE CALI
Informe Ejecutivo XXXXX
' );

$section->addText( 'COORDINADORES DE EJE:
Eje X. xxxxxxxxxxxxxxxxxxxxxxx
xxxxxxxxxxxxxxx – Universidad del Valle
xxxxxxxxxxxx – Secretaría de educación municipal
' );

$section->addText( 'COORDINADOR DE PROYECTO:
xxxxxxxxxxxxxxx – Universidad del Valle
xxxxxxxxxxxx – Secretaría de educación municipal
' );

$section->addText( 'Presentado a: 
Alcaldía de Santiago de Cali
Secretaría de Educación Municipal (S.E.M.)
' );


$section->addText( 'Cali, Valle del Cauca
2018
' );

// Agregando texto con una fuenta personalizada usando font style...
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 14, 'color' => '1B2232', 'bold' => true)
);

$section->addText( $institucion->descripcion, $fontStyleName );

// Creando una segunda fuente personalizada
$fontStyleName = 'oneUserDefinedStyle2';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Comic Sans MS', 'size' => 12, 'color' => '1B2232', 'bold' => true)
);
$section->addText( 'Y la sede que selección es:' );
$section->addText( $sede->descripcion, $fontStyleName );


$section->addText( 'Esta es una imagen de prueba:' );

//Agregando una imgaen
$section->addImage(
    './images/ImagenCriteriosObjetivos.jpg',
    array(
        'width'         => 100,
        'height'        => 100,
        'marginTop'     => -1,
        'marginLeft'    => -1,
        'wrappingStyle' => 'behind'
    )
);

// Creando una tercera fuente personalizada
$fontStyleName = 'oneUserDefinedStyle3';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Arial', 'size' => 10, 'color' => '1B2232', 'bold' => true)
);

$section->addText( 'Todas las personas que están registradas en la base de datos son:' );

//Agregando una tabla
$table = $section->addTable();

$table->addRow();
	
$cell = $table->addCell();
//así también se puede usar la fuente personalizada
$cell->addText( "Nombre completo", "oneUserDefinedStyle3" );

$cell = $table->addCell();
$cell->addText( "Nro de identificación", "oneUserDefinedStyle3" );

foreach( $personas as $key => $value ){
	$table->addRow();
	
	$cell = $table->addCell();
	$cell->addText( $value['nombres']." ".$value['apellidos']  );
	
	$cell = $table->addCell();
	$cell->addText( $value['identificacion']  );
}


// Guardando el archivo
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('helloWorld.docx');

echo "Has clic ". Html::a('aqui', Url::to('@web/helloWorld.docx'), ['class' => 'profile-link'])." para descargar el archivo generado";
