<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeSeguimientoOperadorFrente;

/**
 * GeSeguimientoOperadorFrenteBuscar represents the model behind the search form of `app\models\GeSeguimientoOperadorFrente`.
 */
class GeSeguimientoOperadorFrenteBuscar extends GeSeguimientoOperadorFrente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tipo_seguimiento', 'id_persona_diligencia', 'id_gestor_a_evaluar', 'compromisos_establecidos', 'cuantas_reuniones', 'estado'], 'integer'],
            [['email', 'mes_reporte', 'fecha_corte', 'descripcion_cronograma', 'aportes_reuniones', 'logros', 'dificultades'], 'safe'],
            [['cumple_cronograma'], 'boolean'],
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
        $query = GeSeguimientoOperadorFrente::find();

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
            'id_persona_diligencia' => $this->id_persona_diligencia,
            'id_gestor_a_evaluar' => $this->id_gestor_a_evaluar,
            'fecha_corte' => $this->fecha_corte,
            'cumple_cronograma' => $this->cumple_cronograma,
            'compromisos_establecidos' => $this->compromisos_establecidos,
            'cuantas_reuniones' => $this->cuantas_reuniones,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'mes_reporte', $this->mes_reporte])
            ->andFilterWhere(['ilike', 'descripcion_cronograma', $this->descripcion_cronograma])
            ->andFilterWhere(['ilike', 'aportes_reuniones', $this->aportes_reuniones])
            ->andFilterWhere(['ilike', 'logros', $this->logros])
            ->andFilterWhere(['ilike', 'dificultades', $this->dificultades]);

        return $dataProvider;
    }
}
