<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcRespuestas;

/**
 * EcRespuestasSearch represents the model behind the search form of `app\models\EcRespuestas`.
 */
class EcRespuestasSearch extends EcRespuestas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_estrategia'], 'integer'],
            [['respuesta'], 'safe'],
            [['estado'], 'boolean'],
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
        $query = EcRespuestas::find();

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
            'id_estrategia' => $this->id_estrategia,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'respuesta', $this->respuesta]);

        return $dataProvider;
    }
}
