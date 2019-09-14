<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvanceMisionalEjePpt;

/**
 * EcAvanceMisionalEjePptBuscar represents the model behind the search form of `app\models\EcAvanceMisionalEjePpt`.
 */
class EcAvanceMisionalEjePptBuscar extends EcAvanceMisionalEjePpt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['resposable_sem', 'operador', 'acciones_realizadas', 'proceso_gestion_avances', 'proceso_gestion_dificultades', 'estrategias_avances', 'estrategias_dificultades', 'orientaciones_avances', 'orientaciones_dificultades', 'guia_avances', 'guia_dificultades', 'iniciativas_avances', 'iniciativas_dificultades', 'red_municipal_avances', 'red_municipal_dificultades', 'proyectos_avances', 'proyectos_dificultades', 'dispositivo_avances', 'dispositivo_dificultades', 'fuente_informacion', 'avances_importantes', 'dificultades_importantes', 'alarmas_importantes', 'estado'], 'safe'],
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
        $query = EcAvanceMisionalEjePpt::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'resposable_sem', $this->resposable_sem])
            ->andFilterWhere(['ilike', 'operador', $this->operador])
            ->andFilterWhere(['ilike', 'acciones_realizadas', $this->acciones_realizadas])
            ->andFilterWhere(['ilike', 'proceso_gestion_avances', $this->proceso_gestion_avances])
            ->andFilterWhere(['ilike', 'proceso_gestion_dificultades', $this->proceso_gestion_dificultades])
            ->andFilterWhere(['ilike', 'estrategias_avances', $this->estrategias_avances])
            ->andFilterWhere(['ilike', 'estrategias_dificultades', $this->estrategias_dificultades])
            ->andFilterWhere(['ilike', 'orientaciones_avances', $this->orientaciones_avances])
            ->andFilterWhere(['ilike', 'orientaciones_dificultades', $this->orientaciones_dificultades])
            ->andFilterWhere(['ilike', 'guia_avances', $this->guia_avances])
            ->andFilterWhere(['ilike', 'guia_dificultades', $this->guia_dificultades])
            ->andFilterWhere(['ilike', 'iniciativas_avances', $this->iniciativas_avances])
            ->andFilterWhere(['ilike', 'iniciativas_dificultades', $this->iniciativas_dificultades])
            ->andFilterWhere(['ilike', 'red_municipal_avances', $this->red_municipal_avances])
            ->andFilterWhere(['ilike', 'red_municipal_dificultades', $this->red_municipal_dificultades])
            ->andFilterWhere(['ilike', 'proyectos_avances', $this->proyectos_avances])
            ->andFilterWhere(['ilike', 'proyectos_dificultades', $this->proyectos_dificultades])
            ->andFilterWhere(['ilike', 'dispositivo_avances', $this->dispositivo_avances])
            ->andFilterWhere(['ilike', 'dispositivo_dificultades', $this->dispositivo_dificultades])
            ->andFilterWhere(['ilike', 'fuente_informacion', $this->fuente_informacion])
            ->andFilterWhere(['ilike', 'avances_importantes', $this->avances_importantes])
            ->andFilterWhere(['ilike', 'dificultades_importantes', $this->dificultades_importantes])
            ->andFilterWhere(['ilike', 'alarmas_importantes', $this->alarmas_importantes])
            ->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
}
