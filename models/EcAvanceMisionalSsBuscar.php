<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvanceMisionalSs;

/**
 * EcAvanceMisionalSsBuscar represents the model behind the search form of `app\models\EcAvanceMisionalSs`.
 */
class EcAvanceMisionalSsBuscar extends EcAvanceMisionalSs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'gestion_institucional_avances', 'gestion_institucional_dificultades', 'proyectos_servicio_social_avances', 'proyectos_servicio_social_difcultades', 'competencias_habilidades_avances', 'competencias_habilidades_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'safe'],
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
        $query = EcAvanceMisionalSs::find();

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
            ->andFilterWhere(['ilike', 'gestion_institucional_avances', $this->gestion_institucional_avances])
            ->andFilterWhere(['ilike', 'gestion_institucional_dificultades', $this->gestion_institucional_dificultades])
            ->andFilterWhere(['ilike', 'proyectos_servicio_social_avances', $this->proyectos_servicio_social_avances])
            ->andFilterWhere(['ilike', 'proyectos_servicio_social_difcultades', $this->proyectos_servicio_social_difcultades])
            ->andFilterWhere(['ilike', 'competencias_habilidades_avances', $this->competencias_habilidades_avances])
            ->andFilterWhere(['ilike', 'competencias_habilidades_dificultades', $this->competencias_habilidades_dificultades])
            ->andFilterWhere(['ilike', 'fuente_informacion', $this->fuente_informacion])
            ->andFilterWhere(['ilike', 'avances_acompanamiento', $this->avances_acompanamiento])
            ->andFilterWhere(['ilike', 'dificultades_acompanamiento', $this->dificultades_acompanamiento])
            ->andFilterWhere(['ilike', 'alarmas_importantes', $this->alarmas_importantes]);

        return $dataProvider;
    }
}
