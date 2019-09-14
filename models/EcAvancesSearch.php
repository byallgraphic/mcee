<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcAvances;

/**
 * EcAvancesSearch represents the model behind the search form of `app\models\EcAvances`.
 */
class EcAvancesSearch extends EcAvances
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_acciones'], 'integer'],
            [['estado_actual', 'logros', 'retos', 'argumentos'], 'safe'],
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
        $query = EcAvances::find();

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
            'id_acciones' => $this->id_acciones,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'estado_actual', $this->estado_actual])
            ->andFilterWhere(['ilike', 'logros', $this->logros])
            ->andFilterWhere(['ilike', 'retos', $this->retos])
            ->andFilterWhere(['ilike', 'argumentos', $this->argumentos]);

        return $dataProvider;
    }
}
