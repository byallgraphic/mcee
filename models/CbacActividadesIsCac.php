<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividades_is_cac".
 *
 * @property int $id
 * @property int $id_informe_semanal_isa
 * @property string $duracion
 * @property string $docente
 * @property string $equipos
 * @property string $logros
 * @property string $variaciones_devilidades
 * @property string $variaciones_fortalezas
 * @property string $retos
 * @property string $articulacion
 * @property string $alrmas
 * @property int $estado
 * @property int $id_actividad
 * @property int $id_componente
 */
class CbacActividadesIsCac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividades_is_cac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_informe_semanal_isa', 'estado', 'id_actividad', 'id_componente'], 'default', 'value' => null],
            [['id_informe_semanal_isa', 'estado', 'id_actividad', 'id_componente'], 'integer'],
            [['duracion', 'docente', 'equipos', 'logros', 'variaciones_devilidades', 'variaciones_fortalezas', 'retos', 'articulacion', 'alrmas'], 'string'],
            [['duracion', 'docente', 'equipos', 'logros', 'variaciones_devilidades', 'variaciones_fortalezas', 'retos', 'articulacion', 'alrmas'],'required'],
            [['id_informe_semanal_isa'], 'exist', 'skipOnError' => true, 'targetClass' => CbacInformeSemanalCac::className(), 'targetAttribute' => ['id_informe_semanal_isa' => 'id']],
            [['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_informe_semanal_isa' => 'Id Informe Semanal Isa',
            'duracion' => 'Duración de cada sesión (Indique el tiempo  en horas y minutos)',
            'docente' => 'Docente orientador(a)',
            'equipos' => 'Equipo(s) encargado(s) Nº',
            'logros' => 'Logros: Resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando desarrollar herramientas en docentes y directivos docentes que implementen componentes artísticos y culturales..)',
            'variaciones_devilidades' => 'Debilidades que se presentaron o detectaron en el desarrollo de la actividad y que pueden afectar negativamente el  cumplimiento de los objetivos.',
            'variaciones_fortalezas' => 'Fortalezas que se detectaron en el desarrollo de la actividad para potenciar los objetivos del proyecto.',
            'retos' => 'Retos (Condiciones externas a tener en cuenta y que pueden afectar o beneficiar el logro de  los objetivos del proyecto)',
            'articulacion' => 'Articulación  Resultado de la articulación con otros proyectos de la iniciativa MCEE',
            'alrmas' => 'Alarmas:  Situaciones emergentes que pueden impedir el desarrollo de actividades y/o el logro de objetivos.',
            'estado' => 'Estado',
            'id_actividad' => 'Id Actividad',
            'id_componente' => 'Id Componente',
        ];
    }
}
