<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GcMomento2;

/**
 * GcMomento2Buscar represents the model behind the search form of `app\models\GcMomento2`.
 */
class GcMomento2Buscar extends GcMomento2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_semana', 'estudiantes', 'docentes', 'directivos', 'otro', 'estado'], 'integer'],
            [['realizo_visita'], 'boolean'],
            [['justificacion_no_visita'], 'safe'],
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
        $query = GcMomento2::find();

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
            'id_semana' => $this->id_semana,
            'realizo_visita' => $this->realizo_visita,
            'estudiantes' => $this->estudiantes,
            'docentes' => $this->docentes,
            'directivos' => $this->directivos,
            'otro' => $this->otro,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'justificacion_no_visita', $this->justificacion_no_visita]);

        return $dataProvider;
    }
}
