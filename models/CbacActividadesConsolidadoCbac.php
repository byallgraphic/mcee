<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividades_consolidado_cbac".
 *
 * @property int $id
 * @property string $id_imp_consolidado_mes_cbac
 * @property string $id_actividad
 * @property string $nombre
 * @property string $avance_sede
 * @property string $avance_ieo
 * @property string $sesiones_realizadas
 * @property string $sesiones_canceladas
 */
class CbacActividadesConsolidadoCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividades_consolidado_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_imp_consolidado_mes_cbac', 'id_actividad', 'avance_sede', 'avance_ieo', 'sesiones_realizadas', 'sesiones_canceladas'], 'default', 'value' => null],
            [['id_imp_consolidado_mes_cbac', 'id_actividad', 'avance_sede', 'avance_ieo', 'sesiones_realizadas', 'sesiones_canceladas'], 'integer'],
            [['nombre'], 'string'],
            //[['avance_sede', 'avance_ieo', 'sesiones_realizadas', 'sesiones_canceladas'], 'required'],
            [['id_imp_consolidado_mes_cbac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacImpConsolidadoMesCbac::className(), 'targetAttribute' => ['id_imp_consolidado_mes_cbac' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_imp_consolidado_mes_cbac' => 'Id Imp Consolidado Mes Cbac',
            'id_actividad' => 'Id Actividad',
            'nombre' => 'Nombre',
            'avance_sede' => '% Avance por sede',
            'avance_ieo' => '% Avance por IEO',
            'sesiones_realizadas' => 'Total de sesiones aplazadas en el mes',
            'sesiones_canceladas' => 'Total de sesiones canceladas en el mes',
        ];
    }
}
