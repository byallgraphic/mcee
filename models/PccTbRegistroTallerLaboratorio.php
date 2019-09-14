<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_RegistroTallerLaboratorio".
 *
 * @property string $Id_accion
 * @property string $Id_formador
 * @property string $Primer_nombre
 * @property string $Primer_apellido
 * @property string $IE
 * @property string $Tipo_sesion
 * @property string $Grupo
 * @property string $Fecha_desarrollo
 * @property string $Cumplimiento_de_cronograma
 * @property string $Descripcion_novedades
 * @property string $Ajustes_logisticos
 * @property string $Descripcion_ajustes
 * @property string $Ajustes_planeacion
 * @property string $Describa_ajustes_p
 * @property string $Participantes
 * @property string $Inscritos
 * @property string $Asistentes
 * @property string $No_asistentes
 * @property string $Descripcion_ambiente_p
 * @property string $Desempeno_grupal
 * @property string $Pregunta_interdiciplinaria
 * @property string $Respuesta_interdiciplinaria
 * @property string $Retos_dificultades
 * @property string $Observaciones
 * @property string $Registro_refrigerio
 * @property string $Descripcion_registro_refri
 * @property string $Registro_materiales
 * @property string $Descripcion_registro_mate
 * @property string $Registro_sesion
 * @property string $Descripcion_registro_sesion
 * @property string $Valida_unico
 */
class PccTbRegistroTallerLaboratorio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_RegistroTallerLaboratorio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_desarrollo'], 'safe'],
            [['Descripcion_novedades', 'Descripcion_ajustes', 'Describa_ajustes_p', 'Participantes', 'Descripcion_ambiente_p', 'Desempeno_grupal', 'Respuesta_interdiciplinaria', 'Retos_dificultades', 'Observaciones', 'Registro_refrigerio', 'Registro_materiales', 'Registro_sesion'], 'string'],
            [['Id_accion'], 'string', 'max' => 30],
            [['Id_formador', 'Inscritos', 'Asistentes', 'No_asistentes'], 'string', 'max' => 320],
            [['Primer_nombre', 'Primer_apellido', 'IE', 'Tipo_sesion', 'Grupo', 'Cumplimiento_de_cronograma', 'Ajustes_logisticos', 'Ajustes_planeacion', 'Pregunta_interdiciplinaria', 'Descripcion_registro_refri', 'Descripcion_registro_mate', 'Descripcion_registro_sesion', 'Valida_unico'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_accion' => 'Id Accion',
            'Id_formador' => 'Id Formador',
            'Primer_nombre' => 'Primer Nombre',
            'Primer_apellido' => 'Primer Apellido',
            'IE' => 'Ie',
            'Tipo_sesion' => 'Tipo Sesion',
            'Grupo' => 'Grupo',
            'Fecha_desarrollo' => 'Fecha Desarrollo',
            'Cumplimiento_de_cronograma' => 'Cumplimiento De Cronograma',
            'Descripcion_novedades' => 'Descripcion Novedades',
            'Ajustes_logisticos' => 'Ajustes Logisticos',
            'Descripcion_ajustes' => 'Descripcion Ajustes',
            'Ajustes_planeacion' => 'Ajustes Planeacion',
            'Describa_ajustes_p' => 'Describa Ajustes P',
            'Participantes' => 'Participantes',
            'Inscritos' => 'Inscritos',
            'Asistentes' => 'Asistentes',
            'No_asistentes' => 'No Asistentes',
            'Descripcion_ambiente_p' => 'Descripcion Ambiente P',
            'Desempeno_grupal' => 'Desempeno Grupal',
            'Pregunta_interdiciplinaria' => 'Pregunta Interdiciplinaria',
            'Respuesta_interdiciplinaria' => 'Respuesta Interdiciplinaria',
            'Retos_dificultades' => 'Retos Dificultades',
            'Observaciones' => 'Observaciones',
            'Registro_refrigerio' => 'Registro Refrigerio',
            'Descripcion_registro_refri' => 'Descripcion Registro Refri',
            'Registro_materiales' => 'Registro Materiales',
            'Descripcion_registro_mate' => 'Descripcion Registro Mate',
            'Registro_sesion' => 'Registro Sesion',
            'Descripcion_registro_sesion' => 'Descripcion Registro Sesion',
            'Valida_unico' => 'Valida Unico',
        ];
    }
}
