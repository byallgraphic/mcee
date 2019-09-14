<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GcBitacora;

/**
 * GcBitacoraBuscar represents the model behind the search form of `app\models\GcBitacora`.
 */
class GcBitacoraBuscar extends GcBitacora
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ciclo', 'id_jefe', 'id_sede', 'estado', 'jornada'], 'integer'],
            [['observaciones'], 'safe'],
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
        $query = GcBitacora::find();

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
            'id_ciclo' => $this->id_ciclo,
            'id_jefe' => $this->id_jefe,
            'id_sede' => $this->id_sede,
            'estado' => $this->estado,
            'jornada' => $this->jornada,
        ]);

        $query->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
