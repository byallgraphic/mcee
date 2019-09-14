<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PppSeguimientoOperador;

/**
 * PppSeguimientoOperadorBuscar represents the model behind the search form of `app\models\PppSeguimientoOperador`.
 */
class PppSeguimientoOperadorBuscar extends PppSeguimientoOperador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tipo_seguimiento', 'id_ie', 'id_persona_responsable', 'estado'], 'integer'],
            [['email', 'id_operador', 'cual_operador', 'proyecto_reportar', 'mes_reporte', 'semana_reporte', 'descripcion_actividad', 'poblacion_beneficiaria', 'quienes', 'duracion_actividad', 'logros_alcanzados', 'dificultadades', 'avances_cumplimiento_cuantitativos', 'avances_cumplimiento_cualitativos', 'propuesta_dificultades'], 'safe'],
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
        $query = PppSeguimientoOperador::find();

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
            'id_persona_responsable' => $this->id_persona_responsable,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'id_operador', $this->id_operador])
            ->andFilterWhere(['ilike', 'cual_operador', $this->cual_operador])
            ->andFilterWhere(['ilike', 'proyecto_reportar', $this->proyecto_reportar])
            ->andFilterWhere(['ilike', 'mes_reporte', $this->mes_reporte])
            ->andFilterWhere(['ilike', 'semana_reporte', $this->semana_reporte])
            ->andFilterWhere(['ilike', 'quienes', $this->quienes])
            ->andFilterWhere(['ilike', 'avances_cumplimiento_cuantitativos', $this->avances_cumplimiento_cuantitativos])
            ->andFilterWhere(['ilike', 'avances_cumplimiento_cualitativos', $this->avances_cumplimiento_cualitativos])
            ->andFilterWhere(['ilike', 'propuesta_dificultades', $this->propuesta_dificultades]);

        return $dataProvider;
    }
}
