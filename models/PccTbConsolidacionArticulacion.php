<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_ConsolidacionArticulacion".
 *
 * @property string $Id
 * @property string $Fecha_accion
 * @property string $Id_formador
 * @property string $Nombre1
 * @property string $Apellido1
 * @property string $IE
 * @property string $Mes
 * @property string $Avance_actores
 * @property string $Avance_transv
 * @property string $Insercion_PEI
 * @property string $Avance_biblio
 * @property string $Avance_otros
 * @property string $Adjuntos
 * @property string $Observaciones
 */
class PccTbConsolidacionArticulacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_ConsolidacionArticulacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_accion'], 'safe'],
            [['Avance_actores', 'Avance_transv', 'Insercion_PEI', 'Avance_biblio', 'Avance_otros', 'Adjuntos', 'Observaciones'], 'string'],
            [['Id'], 'string', 'max' => 10],
            [['Id_formador'], 'string', 'max' => 320],
            [['Nombre1', 'Apellido1', 'IE', 'Mes'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Fecha_accion' => 'Fecha Accion',
            'Id_formador' => 'Id Formador',
            'Nombre1' => 'Nombre1',
            'Apellido1' => 'Apellido1',
            'IE' => 'Ie',
            'Mes' => 'Mes',
            'Avance_actores' => 'Avance Actores',
            'Avance_transv' => 'Avance Transv',
            'Insercion_PEI' => 'Insercion  Pei',
            'Avance_biblio' => 'Avance Biblio',
            'Avance_otros' => 'Avance Otros',
            'Adjuntos' => 'Adjuntos',
            'Observaciones' => 'Observaciones',
        ];
    }
}
