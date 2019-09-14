<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.documentos_reconocimiento".
 *
 * @property int $id
 * @property int $ieo_id
 * @property string $informe_caracterizacion
 * @property string $matriz_caracterizacion
 * @property string $revision_pei
 * @property string $revision_autoevaluacion
 * @property string $revision_pmi
 * @property string $resultados_caracterizacion
 * @property string $horario_trabajo
 * @property int $proyecto_ieo_id
 * @property int $actividad_id
 */
class DocumentosReconocimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.documentos_reconocimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ieo_id', 'proyecto_ieo_id', 'actividad_id'], 'default', 'value' => null],
            [['ieo_id', 'proyecto_ieo_id', 'actividad_id'], 'integer'],
            [['informe_caracterizacion', 'matriz_caracterizacion', 'revision_pei', 'revision_autoevaluacion', 'revision_pmi', 'resultados_caracterizacion', 'horario_trabajo'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ieo_id' => 'Ieo ID',
            'informe_caracterizacion' => 'Informe Caracterizacion',
            'matriz_caracterizacion' => 'Matriz Caracterizacion',
            'revision_pei' => 'Revision Pei',
            'revision_autoevaluacion' => 'Revision Autoevaluacion',
            'revision_pmi' => 'Revision Pmi',
            'resultados_caracterizacion' => 'Resultados Caracterizacion',
            'horario_trabajo' => 'Horario Trabajo',
            'proyecto_ieo_id' => 'Proyecto Ieo ID',
            'actividad_id' => 'Actividad ID',
        ];
    }
}
