<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcInformeAvanceEjecucionMisional;

/**
 * EcInformeAvanceEjecucionMisionalBuscar represents the model behind the search form of `app\models\EcInformeAvanceEjecucionMisional`.
 */
class EcInformeAvanceEjecucionMisionalBuscar extends EcInformeAvanceEjecucionMisional
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_eje', 'id_coordinador', 'id_secretaria', 'estado','id_tipo_informe'], 'integer'],
            [['descripcion', 'presentacion', 'productos', 'presentacion_retos', 'alarmas', 'consolidad_avance', 'fecha_creacion'], 'safe'],
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
        $query = EcInformeAvanceEjecucionMisional::find();

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
            'id_eje' => $this->id_eje,
            'id_coordinador' => $this->id_coordinador,
            'id_secretaria' => $this->id_secretaria,
            'fecha_creacion' => $this->fecha_creacion,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'presentacion', $this->presentacion])
            ->andFilterWhere(['ilike', 'productos', $this->productos])
            ->andFilterWhere(['ilike', 'presentacion_retos', $this->presentacion_retos])
            ->andFilterWhere(['ilike', 'alarmas', $this->alarmas])
            ->andFilterWhere(['ilike', 'consolidad_avance', $this->consolidad_avance]);

        return $dataProvider;
    }
}
