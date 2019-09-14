<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcLevantamientoOrientacion;

/**
 * EcLevantamientoOrientacionBuscar represents the model behind the search form of `app\models\EcLevantamientoOrientacion`.
 */
class EcLevantamientoOrientacionBuscar extends EcLevantamientoOrientacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'id_tipo_levantamiento', 'estado'], 'integer'],
            [['visita_realizada', 'actividad_seguimiento', 'profesional_encargado', 'fortalezas_identificadas', 'necesidades_orientacion', 'observacion_general', 'uso_insumo'], 'safe'],
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
        $query = EcLevantamientoOrientacion::find();

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
            'id_institucion' => $this->id_institucion,
            'id_sede' => $this->id_sede,
            'visita_realizada' => $this->visita_realizada,
            'id_tipo_levantamiento' => $this->id_tipo_levantamiento,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'actividad_seguimiento', $this->actividad_seguimiento])
            ->andFilterWhere(['ilike', 'profesional_encargado', $this->profesional_encargado])
            ->andFilterWhere(['ilike', 'fortalezas_identificadas', $this->fortalezas_identificadas])
            ->andFilterWhere(['ilike', 'necesidades_orientacion', $this->necesidades_orientacion])
            ->andFilterWhere(['ilike', 'observacion_general', $this->observacion_general])
            ->andFilterWhere(['ilike', 'uso_insumo', $this->uso_insumo]);

        return $dataProvider;
    }
}
