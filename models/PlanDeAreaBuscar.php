<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlanDeArea;

/**
 * PlanDeAreaBuscar represents the model behind the search form of `app\models\PlanDeArea`.
 */
class PlanDeAreaBuscar extends PlanDeArea
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado', 'id_tipos_documentos'], 'integer'],
            [['descripcion', 'ruta'], 'safe'],
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
        $query = PlanDeArea::find();

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
            'id_tipos_documentos' => $this->id_tipos_documentos,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'ruta', $this->ruta]);

        return $dataProvider;
    }
}
