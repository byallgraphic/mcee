<?php

/**
Modificaciones:
Fecha: 2019-02-12
Descripción: Se elimina atributo id_ciclo y se cambia por anio
---------------------------------------
Fecha: 2018-10-16
Descripción: Se agrega campo sesiones_por_docente
---------------------------------------
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.condiciones_institucionales".
 *
 * @property string $id
 * @property string $parte_ieo
 * @property string $parte_univalle
 * @property string $parte_sem
 * @property string $otro
 * @property string $id_datos_ieo_profesional
 * @property string $estado
 * @property string $total_sesiones_ieo
 * @property string $total_docentes_ieo
 */
class CondicionesInstitucionales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.condiciones_institucionales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parte_ieo', 'parte_univalle', 'parte_sem', 'otro', 'id_datos_ieo_profesional', 'estado', 'total_sesiones_ieo', 'total_docentes_ieo','sesiones_por_docente','id_fase'], 'required'],
            [['id_datos_ieo_profesional', 'estado'], 'default', 'value' => null],
            [['total_apps'], 'default', 'value' => 0 ],
            [['id_datos_ieo_profesional', 'estado','total_apps','anio'], 'integer'],
            [['parte_ieo', 'parte_univalle', 'parte_sem', 'otro', 'total_sesiones_ieo', 'total_docentes_ieo'], 'string', 'max' => 500],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_datos_ieo_profesional'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosIeoProfesional::className(), 'targetAttribute' => ['id_datos_ieo_profesional' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 						=> 'ID',
            'parte_ieo' 				=> 'Parte Ieo',
            'parte_univalle' 			=> 'Parte Univalle',
            'parte_sem' 				=> 'Parte Sem',
            'otro' 						=> 'Otro',
            'id_datos_ieo_profesional' 	=> 'Id Datos Ieo Profesional',
            'estado' 					=> 'Estado',
            'total_sesiones_ieo' 		=> 'Total Sesiones Ieo',
            'total_docentes_ieo' 		=> 'Total Docentes Ieo',
            'sesiones_por_docente' 		=> 'Sesiones por Docente',
            'id_fase' 					=> 'ID Fase',
            'anio' 						=> 'Año',
            'total_apps'				=> 'Total apps desarrolladas',
        ];
    }
}
