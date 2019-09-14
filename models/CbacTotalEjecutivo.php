<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.total_ejecutivo".
 *
 * @property int $id
 * @property string $objetivos_generale
 * @property string $objetivos_especificos
 * @property string $id_actividad
 * @property int $avance_objetivos_sede
 * @property int $avance_ieo
 * @property int $avance_actividad_sede
 * @property int $avance_actividad_ieo
 * @property int $beneficiarios
 * @property int $sesiones_realizadas_ieo
 * @property int $sesiones_aplazadas_ieo
 * @property int $sesiones_canceladas_ieo
 * @property int $id_institucion
 * @property int $id_sede
 */
class CbacTotalEjecutivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.total_ejecutivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivos_generale', 'objetivos_especificos', 'id_actividad'], 'string'],
            [['avance_objetivos_sede', 'avance_ieo', 'avance_actividad_sede', 'avance_actividad_ieo', 'beneficiarios', 'sesiones_realizadas_ieo', 'sesiones_aplazadas_ieo', 'sesiones_canceladas_ieo', 'id_institucion', 'id_sede'], 'default', 'value' => null],
            [['avance_objetivos_sede', 'avance_ieo', 'avance_actividad_sede', 'avance_actividad_ieo', 'beneficiarios', 'sesiones_realizadas_ieo', 'sesiones_aplazadas_ieo', 'sesiones_canceladas_ieo', 'id_institucion', 'id_sede'], 'integer'],
            [['avance_objetivos_sede', 'avance_ieo', 'avance_actividad_sede', 'avance_actividad_ieo', 'beneficiarios', 'sesiones_realizadas_ieo', 'sesiones_aplazadas_ieo', 'sesiones_canceladas_ieo'], 'required'],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivos_generale' => '',
            'objetivos_especificos' => '',
            'id_actividad' => '',
            'avance_objetivos_sede' => '',
            'avance_ieo' => '',
            'avance_actividad_sede' => '',
            'avance_actividad_ieo' => '',
            'beneficiarios' => '',
            'sesiones_realizadas_ieo' => '',
            'sesiones_aplazadas_ieo' => '',
            'sesiones_canceladas_ieo' => '',
            'id_institucion' => '',
            'id_sede' => '',
        ];
    }
}
