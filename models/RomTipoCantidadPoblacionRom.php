<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rom.tipo_cantidad_poblacion_rom".
 *
 * @property int $id
 * @property int $id_actividad_rom
 * @property string $vecinos
 * @property string $lideres_comunitarios
 * @property string $empresarios_comerciantes
 * @property string $organizaciones_locales
 * @property string $grupos_comunitarios
 * @property string $otos_actores
 * @property string $total_participantes
 * @property int $estado
 */
class RomTipoCantidadPoblacionRom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.tipo_cantidad_poblacion_rom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad_rom', 'estado'], 'default', 'value' => null],
            [['id_actividad_rom', 'estado'], 'integer'],
			[['id_actividad_rom', 'estado','id_actividad_rom','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores'], 'required'],
            [['vecinos', 'lideres_comunitarios', 'empresarios_comerciantes', 'organizaciones_locales', 'grupos_comunitarios', 'otos_actores', 'total_participantes','total_participantes','vecinos'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_actividad_rom'], 'exist', 'skipOnError' => true, 'targetClass' => RomActividadesRom::className(), 'targetAttribute' => ['id_actividad_rom' => 'id']],
			[['id_actividad_rom','vecinos','lideres_comunitarios','empresarios_comerciantes','organizaciones_locales','grupos_comunitarios','otos_actores','total_participantes','estado'], 'required'],
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividad_rom' => 'Id Actividad Rom',
            'vecinos' => 'Vecinos',
            'lideres_comunitarios' => 'Líderes Comunitarios',
            'empresarios_comerciantes' => 'Empresarios Comerciantes',
            'organizaciones_locales' => 'Organizaciones Locales',
            'grupos_comunitarios' => 'Grupos Comunitarios',
            'otos_actores' => 'Otos Actores',
            'total_participantes' => 'Total Participantes',
            'estado' => 'Estado',
        ];
    }
}
