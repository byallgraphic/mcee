<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.tipo_cantidad_poblacion_rom".
 *
 * @property int $id
 * @property string $vecinos
 * @property string $lideres_comunitarios
 * @property string $empresarios_comerciantes
 * @property string $organizaciones_locales
 * @property string $grupos_comunitarios
 * @property string $otos_actores
 * @property string $total_participantes
 * @property string $estado
 * @property string $id_rom_actividades
 * @property string $id_reporte_operativo_misional
 */
class CbacTipoCantidadPoblacionRom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.tipo_cantidad_poblacion_rom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['vecinos', 'lideres_comunitarios', 'empresarios_comerciantes', 'organizaciones_locales', 'grupos_comunitarios', 'otos_actores', 'total_participantes', 'estado', 'id_rom_actividades', 'id_reporte_operativo_misional'], 'required'],
            [['estado', 'id_rom_actividades', 'id_reporte_operativo_misional'], 'required'],
            [['vecinos', 'lideres_comunitarios', 'empresarios_comerciantes', 'organizaciones_locales', 'grupos_comunitarios', 'otos_actores', 'total_participantes'], 'string'],
            [['estado', 'id_rom_actividades', 'id_reporte_operativo_misional'], 'default', 'value' => null],
            [['estado', 'id_rom_actividades', 'id_reporte_operativo_misional'], 'integer'],
            [['id_reporte_operativo_misional'], 'exist', 'skipOnError' => true, 'targetClass' => CbacReporteOperativoMisional::className(), 'targetAttribute' => ['id_reporte_operativo_misional' => 'id']],
            [['id_rom_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => CbacRomActividades::className(), 'targetAttribute' => ['id_rom_actividades' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vecinos' => 'Vecinos',
            'lideres_comunitarios' => 'Líderes Comunitarios',
            'empresarios_comerciantes' => 'Empresarios Comerciantes',
            'organizaciones_locales' => 'Organizaciones Locales',
            'grupos_comunitarios' => 'Grupos Comunitarios',
            'otos_actores' => 'Otos Actores',
            'total_participantes' => 'Total Participantes',
            'estado' => 'Estado',
            'id_rom_actividades' => 'Id Rom Actividades',
            'id_reporte_operativo_misional' => 'Id Reporte Operativo Misional',
        ];
    }
}
