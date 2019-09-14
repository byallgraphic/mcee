<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.tipo_cantidad_poblacion_is_cac".
 *
 * @property int $id
 * @property int $id_actividades_is_cac
 * @property int $ciencias_naturales
 * @property int $ciencias_sociales
 * @property int $educacion_artistica
 * @property int $educacion_etica
 * @property int $educacion_fisica
 * @property int $educacion_religiosa
 * @property int $estadistica
 * @property int $humanidades
 * @property int $idiomas_extranjeros
 * @property int $lengua_castellana
 * @property int $matematicas
 * @property int $tecnologia
 * @property int $otras
 * @property int $docentes_partipantes_sede
 * @property int $rectora
 * @property int $coordinadores
 * @property int $directivos_partipantes_sede
 * @property int $estado
 */
class CbacTipoCantidadPoblacionIsCac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.tipo_cantidad_poblacion_is_cac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_cac', 'ciencias_naturales', 'ciencias_sociales', 'educacion_artistica', 'educacion_etica', 'educacion_fisica', 'educacion_religiosa', 'estadistica', 'humanidades', 'idiomas_extranjeros', 'lengua_castellana', 'matematicas', 'tecnologia', 'otras', 'docentes_partipantes_sede', 'rectora', 'coordinadores', 'directivos_partipantes_sede', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_cac', 'ciencias_naturales', 'ciencias_sociales', 'educacion_artistica', 'educacion_etica', 'educacion_fisica', 'educacion_religiosa', 'estadistica', 'humanidades', 'idiomas_extranjeros', 'lengua_castellana', 'matematicas', 'tecnologia', 'otras', 'docentes_partipantes_sede', 'rectora', 'coordinadores', 'directivos_partipantes_sede', 'estado'], 'integer'],
            [['id_actividades_is_cac', 'ciencias_naturales', 'ciencias_sociales', 'educacion_artistica', 'educacion_etica', 'educacion_fisica', 'educacion_religiosa', 'estadistica', 'humanidades', 'idiomas_extranjeros', 'lengua_castellana', 'matematicas', 'tecnologia', 'otras', 'docentes_partipantes_sede', 'rectora', 'coordinadores', 'directivos_partipantes_sede'], 'required'],
            [['id_actividades_is_cac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesIsCac::className(), 'targetAttribute' => ['id_actividades_is_cac' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividades_is_cac' => 'Id Actividades Is Cac',
            'ciencias_naturales' => 'Ciencias naturales y educación ambiental, biología, física, química.',
            'ciencias_sociales' => 'Ciencias Sociales, historia, geografía, constitución política y democracia, economía política.',
            'educacion_artistica' => 'Educación artística',
            'educacion_etica' => 'Educación ética y valores humanos',
            'educacion_fisica' => ' Educación Física, recreación y deportes',
            'educacion_religiosa' => 'Educación religiosa',
            'estadistica' => 'Estadística',
            'humanidades' => 'Humanidades, filosofía',
            'idiomas_extranjeros' => 'Idiomas extranjeros',
            'lengua_castellana' => 'Lengua castellana',
            'matematicas' => 'Matemáticas, algebra, geometría, trigonometría, cálculo',
            'tecnologia' => 'Tecnología e Informática',
            'otras' => 'Otras áreas ',
            'docentes_partipantes_sede' => 'Número de docentes participantes por sede educativa en la actividad',
            'rectora' => 'Rector(a)',
            'coordinadores' => 'Coordinadores',
            'directivos_partipantes_sede' => 'Número de directivos docentes participantes por sede educativa en la actividad',
            'estado' => 'Estado',
        ];
    }
}
