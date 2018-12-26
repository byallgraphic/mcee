<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IsaSeguimientoProceso;

/**
 * IsaSeguimientoProcesoBuscar represents the model behind the search form of `app\models\IsaSeguimientoProceso`.
 */
class IsaSeguimientoProcesoBuscar extends IsaSeguimientoProceso
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'estado'], 'integer'],
            [['seguimiento_proceso', 'fecha_desde', 'fecha_hasta'], 'safe'],
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
        $query = IsaSeguimientoProceso::find();

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
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'id_institucion' => $this->id_institucion,
            'id_sede' => $this->id_sede,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'seguimiento_proceso', $this->seguimiento_proceso]);

        return $dataProvider;
    }
}
