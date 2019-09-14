<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcProyectos;

/**
 * EcProyectosSearch represents the model behind the search form of `app\models\EcProyectos`.
 */
class EcProyectosSearch extends EcProyectos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_informe_planeacion_ieo'], 'integer'],
            [['descripcion', 'horario'], 'safe'],
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
        $query = EcProyectos::find();

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
            'id_informe_planeacion_ieo' => $this->id_informe_planeacion_ieo,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'horario', $this->horario]);

        return $dataProvider;
    }
}
