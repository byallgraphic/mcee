<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcInformeEjecutivoEstado;

/**
 * EcInformeEjecutivoEstadoBuscar represents the model behind the search form of `app\models\EcInformeEjecutivoEstado`.
 */
class EcInformeEjecutivoEstadoBuscar extends EcInformeEjecutivoEstado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_eje', 'id_persona', 'id_coordinador', 'id_secretaria', 'estado','id_tipo_informe'], 'integer'],
            [['mision', 'descripcion', 'avance_producto', 'hallazgos', 'logros', 'fecha_creacion'], 'safe'],
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
        $query = EcInformeEjecutivoEstado::find();

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
            'id_persona' => $this->id_persona,
            'id_coordinador' => $this->id_coordinador,
            'id_secretaria' => $this->id_secretaria,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'mision', $this->mision])
            ->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'avance_producto', $this->avance_producto])
            ->andFilterWhere(['ilike', 'hallazgos', $this->hallazgos])
            ->andFilterWhere(['ilike', 'logros', $this->logros])
            ->andFilterWhere(['ilike', 'fecha_creacion', $this->fecha_creacion]);

        return $dataProvider;
    }
}
