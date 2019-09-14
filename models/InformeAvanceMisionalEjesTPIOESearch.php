<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcInformePlaneacionIeo;

/**
 * EcInformePlaneacionIeoSearch represents the model behind the search form of `app\models\EcInformePlaneacionIeo`.
 */
class InformeAvanceMisionalEjesTPIOE extends EcInformePlaneacionIeo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'codigo_dane'], 'integer'],
            [['zona_educativa', 'fase', 'fecha_reporte'], 'safe'],
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
        $query = EcInformePlaneacionIeo::find();

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
            'codigo_dane' => $this->codigo_dane,
            'fecha_reporte' => $this->fecha_reporte,
        ]);

        $query->andFilterWhere(['ilike', 'zona_educativa', $this->zona_educativa])
            ->andFilterWhere(['ilike', 'fase', $this->fase]);

        return $dataProvider;
    }
}
