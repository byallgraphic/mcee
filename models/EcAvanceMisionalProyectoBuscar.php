<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvanceMisionalProyecto;

/**
 * EcAvanceMisionalProyectoBuscar represents the model behind the search form of `app\models\EcAvanceMisionalProyecto`.
 */
class EcAvanceMisionalProyectoBuscar extends EcAvanceMisionalProyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado'], 'integer'],
            [['equipo_sem', 'operado', 'acciones_realizadas', 'actores_lideres', 'proceso_gestion', 'iniciativas_pedagogicas', 'estudiantes', 'fuente_informacion', 'avances_importante', 'dificultades_importantes', 'alarmas_importantes'], 'safe'],
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
        $query = EcAvanceMisionalProyecto::find();

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
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'equipo_sem', $this->equipo_sem])
            ->andFilterWhere(['ilike', 'operado', $this->operado])
            ->andFilterWhere(['ilike', 'acciones_realizadas', $this->acciones_realizadas])
            ->andFilterWhere(['ilike', 'actores_lideres', $this->actores_lideres])
            ->andFilterWhere(['ilike', 'proceso_gestion', $this->proceso_gestion])
            ->andFilterWhere(['ilike', 'iniciativas_pedagogicas', $this->iniciativas_pedagogicas])
            ->andFilterWhere(['ilike', 'estudiantes', $this->estudiantes])
            ->andFilterWhere(['ilike', 'fuente_informacion', $this->fuente_informacion])
            ->andFilterWhere(['ilike', 'avances_importante', $this->avances_importante])
            ->andFilterWhere(['ilike', 'dificultades_importantes', $this->dificultades_importantes])
            ->andFilterWhere(['ilike', 'alarmas_importantes', $this->alarmas_importantes]);

        return $dataProvider;
    }
}
