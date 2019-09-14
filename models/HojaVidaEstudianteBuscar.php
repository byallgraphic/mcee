<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HojaVidaEstudiante;

/**
 * HojaVidaEstudianteBuscar represents the model behind the search form of `app\models\HojaVidaEstudiante`.
 */
class HojaVidaEstudianteBuscar extends HojaVidaEstudiante
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_municipios', 'id_tipos_identificaciones', 'id_estados_civiles', 'id_generos', 'id_barrios_veredas', 'estado'], 'integer'],
            [['usuario', 'psw', 'identificacion', 'nombres', 'apellidos', 'telefonos', 'fecha_nacimiento', 'fecha_registro', 'correo', 'domicilio', 'fecha_ultimo_ingreso', 'hobbies', 'grupo_sanguineo'], 'safe'],
            [['envio_correo'], 'boolean'],
            [['latitud', 'longitud'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public static function search($params)
    {
        $query = HojaVidaEstudiante::find();
        $thisHV = new HojaVidaEstudianteBuscar();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $thisHV->load($params);

        if (!$thisHV->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $thisHV->id,
            'fecha_nacimiento' => $thisHV->fecha_nacimiento,
            'fecha_registro' => $thisHV->fecha_registro,
            'fecha_ultimo_ingreso' => $thisHV->fecha_ultimo_ingreso,
            'envio_correo' => $thisHV->envio_correo,
            'id_municipios' => $thisHV->id_municipios,
            'id_tipos_identificaciones' => $thisHV->id_tipos_identificaciones,
            'latitud' => $thisHV->latitud,
            'longitud' => $thisHV->longitud,
            'id_estados_civiles' => $thisHV->id_estados_civiles,
            'id_generos' => $thisHV->id_generos,
            'id_barrios_veredas' => $thisHV->id_barrios_veredas,
            'estado' => $thisHV->estado,
        ]);

        $query->andFilterWhere(['ilike', 'usuario', $thisHV->usuario])
            ->andFilterWhere(['ilike', 'psw', $thisHV->psw])
            ->andFilterWhere(['ilike', 'identificacion', $thisHV->identificacion])
            ->andFilterWhere(['ilike', 'nombres', $thisHV->nombres])
            ->andFilterWhere(['ilike', 'apellidos', $thisHV->apellidos])
            ->andFilterWhere(['ilike', 'telefonos', $thisHV->telefonos])
            ->andFilterWhere(['ilike', 'correo', $thisHV->correo])
            ->andFilterWhere(['ilike', 'domicilio', $thisHV->domicilio])
            ->andFilterWhere(['ilike', 'hobbies', $thisHV->hobbies])
            ->andFilterWhere(['ilike', 'grupo_sanguineo', $thisHV->grupo_sanguineo]);

        return $dataProvider;
    }
}
