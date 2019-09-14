<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GcCiclos;

/**
 * GcCiclosBuscar represents the model behind the search form of `app\models\GcCiclos`.
 */
class GcCiclosBuscar extends GcCiclos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_creador', 'estado'], 'integer'],
            [['fecha', 'descripcion', 'fecha_inicio', 'fecha_finalizacion', 'fecha_cierre', 'fecha_maxima_acceso'], 'safe'],
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
        $query = GcCiclos::find();

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
            'fecha' => $this->fecha,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_finalizacion' => $this->fecha_finalizacion,
            'fecha_cierre' => $this->fecha_cierre,
            'fecha_maxima_acceso' => $this->fecha_maxima_acceso,
            'id_creador' => $this->id_creador,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
