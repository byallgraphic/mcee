<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvanceMisionalAf;

/**
 * EcAvanceMisionalAfBuscar represents the model behind the search form of `app\models\EcAvanceMisionalAf`.
 */
class EcAvanceMisionalAfBuscar extends EcAvanceMisionalAf
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'acompanamiento_pedagogico_avances', 'acompanamiento_pedagogico_dificultades', 'comunicacion_pedagogica_avances', 'comunicacion_pedagogica_difcultades', 'organismos_mecanismos_avances', 'organismos_mecanismos_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'safe'],
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
        $query = EcAvanceMisionalAf::find();

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
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'responsable_sem', $this->responsable_sem])
            ->andFilterWhere(['ilike', 'operador', $this->operador])
            ->andFilterWhere(['ilike', 'acciones_realizadas', $this->acciones_realizadas])
            ->andFilterWhere(['ilike', 'acompanamiento_pedagogico_avances', $this->acompanamiento_pedagogico_avances])
            ->andFilterWhere(['ilike', 'acompanamiento_pedagogico_dificultades', $this->acompanamiento_pedagogico_dificultades])
            ->andFilterWhere(['ilike', 'comunicacion_pedagogica_avances', $this->comunicacion_pedagogica_avances])
            ->andFilterWhere(['ilike', 'comunicacion_pedagogica_difcultades', $this->comunicacion_pedagogica_difcultades])
            ->andFilterWhere(['ilike', 'organismos_mecanismos_avances', $this->organismos_mecanismos_avances])
            ->andFilterWhere(['ilike', 'organismos_mecanismos_dificultades', $this->organismos_mecanismos_dificultades])
            ->andFilterWhere(['ilike', 'fuente_informacion', $this->fuente_informacion])
            ->andFilterWhere(['ilike', 'avances_acompanamiento', $this->avances_acompanamiento])
            ->andFilterWhere(['ilike', 'dificultades_acompanamiento', $this->dificultades_acompanamiento])
            ->andFilterWhere(['ilike', 'alarmas_importantes', $this->alarmas_importantes]);

        return $dataProvider;
    }
}
