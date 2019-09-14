<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvanceMisionalPpt;

/**
 * EcAvanceMisionalPptBuscar represents the model behind the search form of `app\models\EcAvanceMisionalPpt`.
 */
class EcAvanceMisionalPptBuscar extends EcAvanceMisionalPpt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'procesos_gestion_avances', 'procesos_gestion_dificultades', 'estrategias_tranversalizacion_avances', 'estrategias_tranversalizacion_difcultades', 'orientacion_conceptuales_avances', 'orientacion_conceptuales_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'safe'],
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
        $query = EcAvanceMisionalPpt::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);

        $query->andFilterWhere(['ilike', 'responsable_sem', $this->responsable_sem])
            ->andFilterWhere(['ilike', 'operador', $this->operador])
            ->andFilterWhere(['ilike', 'acciones_realizadas', $this->acciones_realizadas])
            ->andFilterWhere(['ilike', 'procesos_gestion_avances', $this->procesos_gestion_avances])
            ->andFilterWhere(['ilike', 'procesos_gestion_dificultades', $this->procesos_gestion_dificultades])
            ->andFilterWhere(['ilike', 'estrategias_tranversalizacion_avances', $this->estrategias_tranversalizacion_avances])
            ->andFilterWhere(['ilike', 'estrategias_tranversalizacion_difcultades', $this->estrategias_tranversalizacion_difcultades])
            ->andFilterWhere(['ilike', 'orientacion_conceptuales_avances', $this->orientacion_conceptuales_avances])
            ->andFilterWhere(['ilike', 'orientacion_conceptuales_dificultades', $this->orientacion_conceptuales_dificultades])
            ->andFilterWhere(['ilike', 'fuente_informacion', $this->fuente_informacion])
            ->andFilterWhere(['ilike', 'avances_acompanamiento', $this->avances_acompanamiento])
            ->andFilterWhere(['ilike', 'dificultades_acompanamiento', $this->dificultades_acompanamiento])
            ->andFilterWhere(['ilike', 'alarmas_importantes', $this->alarmas_importantes]);

        return $dataProvider;
    }
}
