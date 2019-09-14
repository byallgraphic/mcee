<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaterialesEducativos;

/**
 * MaterialesEducativosBuscar represents the model behind the search form of `app\models\MaterialesEducativos`.
 */
class MaterialesEducativosBuscar extends MaterialesEducativos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tipo', 'autor', 'nivel', 'estado'], 'integer'],
            [['otro_cual', 'nombre_apellidos', 'reseña'], 'safe'],
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
        $query = MaterialesEducativos::find();

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
            'tipo' => $this->tipo,
            'autor' => $this->autor,
            'nivel' => $this->nivel,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'otro_cual', $this->otro_cual])
            ->andFilterWhere(['ilike', 'nombre_apellidos', $this->nombre_apellidos])
            ->andFilterWhere(['ilike', 'reseña', $this->reseña]);

        return $dataProvider;
    }
}
