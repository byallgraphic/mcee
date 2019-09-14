<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeSeguimientoGestion;

/**
 * GeSeguimientoGestionBuscar represents the model behind the search form of `app\models\GeSeguimientoGestion`.
 */
class GeSeguimientoGestionBuscar extends GeSeguimientoGestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tipo_seguimiento', 'id_ie', 'id_cargo', 'id_nombre', 'id_persona_gestor', 'numero_visitas', 'estado'], 'integer'],
            [['fecha', 'socializo_plan', 'plan_trabajo_socializo', 'descripcion_plan_trabajo', 'cronocrama_propuesto', 'descripcion_cronograma', 'avances_proyectos', 'dificultades', 'mejoras', 'observaciones', 'calificacion_nivel', 'descripcion_calificacion'], 'safe'],
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
    public function search($params)
    {
        $query = GeSeguimientoGestion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_tipo_seguimiento' => $this->id_tipo_seguimiento,
            'id_ie' => $this->id_ie,
            'id_cargo' => $this->id_cargo,
            'id_nombre' => $this->id_nombre,
            'fecha' => $this->fecha,
            'id_persona_gestor' => $this->id_persona_gestor,
            'numero_visitas' => $this->numero_visitas,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'socializo_plan', $this->socializo_plan])
            ->andFilterWhere(['ilike', 'plan_trabajo_socializo', $this->plan_trabajo_socializo])
            ->andFilterWhere(['ilike', 'descripcion_plan_trabajo', $this->descripcion_plan_trabajo])
            ->andFilterWhere(['ilike', 'cronocrama_propuesto', $this->cronocrama_propuesto])
            ->andFilterWhere(['ilike', 'descripcion_cronograma', $this->descripcion_cronograma])
            ->andFilterWhere(['ilike', 'avances_proyectos', $this->avances_proyectos])
            ->andFilterWhere(['ilike', 'dificultades', $this->dificultades])
            ->andFilterWhere(['ilike', 'mejoras', $this->mejoras])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones])
            ->andFilterWhere(['ilike', 'calificacion_nivel', $this->calificacion_nivel])
            ->andFilterWhere(['ilike', 'descripcion_calificacion', $this->descripcion_calificacion]);

        return $dataProvider;
    }
}
