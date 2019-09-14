<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.imp_misional".
 *
 * @property int $id
 * @property int $id_consolidado_misional
 * @property string $mison
 * @property string $descripcion
 * @property string $hallazgo
 * @property int $sedes_institucion_1
 * @property int $sedes_institucion_2
 * @property int $docentes_institucion_1
 * @property int $docentes_institucion_2
 * @property int $avance_sede
 * @property int $avance_ieo
 * @property int $componente_id
 */
class CbacImpMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.imp_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_consolidado_misional', 'sedes_institucion_1', 'sedes_institucion_2', 'docentes_institucion_1', 'docentes_institucion_2', 'avance_sede', 'avance_ieo', 'componente_id'], 'default', 'value' => null],
            [['id_consolidado_misional', 'sedes_institucion_1', 'sedes_institucion_2', 'docentes_institucion_1', 'docentes_institucion_2', 'avance_sede', 'avance_ieo', 'componente_id'], 'integer'],
            [['mison', 'descripcion', 'hallazgo'], 'string'],
            [['mison', 'descripcion', 'hallazgo', 'sedes_institucion_1', 'sedes_institucion_2', 'docentes_institucion_1', 'sedes_institucion_2', 'docentes_institucion_1', 'docentes_institucion_2', 'avance_sede', 'avance_ieo'],'required'],
            [['id_consolidado_misional'], 'exist', 'skipOnError' => true, 'targetClass' => CbacConsolidadoMisional::className(), 'targetAttribute' => ['id_consolidado_misional' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_consolidado_misional' => 'Id Consolidado Misional',
            'mison' => 'Misión (objetivos) del acompañamiento propuesta para esta fase de acompañamiento.',
            'descripcion' => 'Descripción general del proceso de acompañamiento adelantado. ',
            'hallazgo' => 'Hallazgos metodológicos del proceso. ',
            'sedes_institucion_1' => '¿Cuántas sedes de instituciones educativas oficiales son actualmente acompañadas para el fortalecimiento de competencias básicas? ',
            'sedes_institucion_2' => '¿Cuántas sedes de instituciones educativas oficiales cuentan con prácticas de aula de los docentes que integran estrategias y métodos provenientes de las artes y la cultura?',
            'docentes_institucion_1' => '¿Cuántos docentes participan por sede educativa en procesos de formación en manejo de herramientas pedagógicas y didácticas?',
            'docentes_institucion_2' => '¿Cuántos directivos docentes por sede educativa participan en procesos de formación en manejo de herramientas pedagógicas y didácticas?',
            'avance_sede' => 'Porcentaje de Avance por Sede',
            'avance_ieo' => 'Porcentaje de Avance por IEO',
            'componente_id' => 'Componente ID',
        ];
    }
}
