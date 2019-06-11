<?php
namespace app\models;

use yii\base\Model;

use yii\validators\FileValidator;

class PoblarTabla extends Model
{
    public $tabla;
    public $schema;
    public $archivo;
	
	public function rules()
	{
		$fileValidator = new FileValidator();
		
		return [
			[['tabla','archivo', 'schema'], 'required'],
			[['archivo'], 'file','maxSize' => $fileValidator->sizeLimit  ],
		];
	}

    public function attributeLabels()
    {
        return [
            'tabla' => 'Tabla',
            'archivo' => 'Archivo',
            'schema' => 'Esquema'
        ];
    }
}