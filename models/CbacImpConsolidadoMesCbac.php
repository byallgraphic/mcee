<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.imp_consolidado_mes_cbac".
 *
 * @property int $id
 * @property string $id_consolidado_mes_cbac
 * @property string $id_componente
 * @property int $avance_sede
 * @property int $avance_ieo
 */
class CbacImpConsolidadoMesCbac extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.imp_consolidado_mes_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consolidado_mes_cbac', 'id_componente', 'avance_sede', 'avance_ieo'], 'default', 'value' => null],
            [['id_consolidado_mes_cbac', 'id_componente', 'avance_sede', 'avance_ieo'], 'integer'],
            //[['avance_sede', 'avance_ieo'],'required'],
            [['id_consolidado_mes_cbac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacConsolidadoMesCbac::className(), 'targetAttribute' => ['id_consolidado_mes_cbac' => 'id']],
            //[['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_consolidado_mes_cbac' => 'Id Consolidado Mes Cbac',
            'id_componente' => 'Id Componente',
            'avance_sede' => 'Porcentaje de Avance por Sede',
            'avance_ieo' => 'Porcentaje de Avance por IEO',
        ];
    }
}
