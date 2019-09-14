<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.tipo_cantidaid_poblacion_consolidado_cbac".
 *
 * @property int $id
 * @property string $id_imp_consolidado_mes_cbac
 * @property int $ciencias_naturales
 * @property int $ciencias_sociales
 * @property int $educacion_artisticas
 * @property int $educacion_etica
 * @property int $educacion_fisica
 * @property int $educacion_religiosa
 * @property int $estadistica
 * @property int $humanidasdes
 * @property int $idiomas_extranjeros
 * @property int $lengua_castellana
 * @property int $matematicas
 * @property int $tecnologia
 * @property int $otras
 * @property int $numero_participantes
 * @property int $rectora
 * @property int $coordinadora
 * @property int $directivos
 * @property int $grado_6
 * @property int $grado_7
 * @property int $grado_8
 * @property int $grado_9
 * @property int $grado_10
 * @property int $grado_11
 * @property string $cuidadores
 * @property string $madres
 * @property string $padres
 * @property string $hermanos
 * @property string $otros_parientes
 */
class CbacTipoCantidaidPoblacionConsolidadoCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.tipo_cantidaid_poblacion_consolidado_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_imp_consolidado_mes_cbac', 'ciencias_naturales', 'ciencias_sociales', 'educacion_artisticas', 'educacion_etica', 'educacion_fisica', 'educacion_religiosa', 'estadistica', 'humanidasdes', 'idiomas_extranjeros', 'lengua_castellana', 'matematicas', 'tecnologia', 'otras', 'numero_participantes', 'rectora', 'coordinadora', 'directivos', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11'], 'default', 'value' => null],
            [['id_imp_consolidado_mes_cbac', 'ciencias_naturales', 'ciencias_sociales', 'educacion_artisticas', 'educacion_etica', 'educacion_fisica', 'educacion_religiosa', 'estadistica', 'humanidasdes', 'idiomas_extranjeros', 'lengua_castellana', 'matematicas', 'tecnologia', 'otras', 'numero_participantes', 'rectora', 'coordinadora', 'directivos', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11'], 'integer'],
            [['cuidadores', 'madres', 'padres', 'hermanos', 'otros_parientes'], 'string'],
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
            'ciencias_naturales' => 'Ciencias naturales y educación ambiental, biología, física, química.',
            'ciencias_sociales' => 'Ciencias Sociales, historia, geografía, constitución política y democracia, economía política.',
            'educacion_artisticas' => 'Educación artística',
            'educacion_etica' => 'Educación ética y valores humanos',
            'educacion_fisica' => ' Educación Física, recreación y deportes',
            'educacion_religiosa' => 'Educación religiosa',
            'estadistica' => 'Estadística',
            'humanidasdes' => 'Humanidades, filosofía',
            'idiomas_extranjeros' => 'Idiomas extranjeros',
            'lengua_castellana' => 'Lengua castellana',
            'matematicas' => 'Matemáticas, algebra, geometría, trigonometría, cálculo',
            'tecnologia' => 'Tecnología e Informática',
            'otras' => 'Otras áreas',
            'numero_participantes' => 'Total de Participantes',
            'rectora' => 'Rector(a)',
            'coordinadora' => 'Coordinadores',
            'directivos' => 'Coordinadores',
            'grado_6' => 'Est.Gra. 6',
            'grado_7' => 'Est.Gra. 7',
            'grado_8' => 'Est.Gra. 8',
            'grado_9' => 'Est.Gra. 9',
            'grado_10' => 'Est.Gra. 10',
            'grado_11' => 'Est.Gra. 11',
            'cuidadores' => 'Cuidadores no parientes',
            'madres' => 'Madres',
            'padres' => 'Padres',
            'hermanos' => 'Hermanos',
            'otros_parientes' => 'Otros Parientes ',
        ];
    }
}
