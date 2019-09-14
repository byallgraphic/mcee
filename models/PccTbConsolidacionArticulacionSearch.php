<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PccTbConsolidacionArticulacion;

/**
 * PccTbConsolidacionArticulacionSearch represents the model behind the search form of `app\models\PccTbConsolidacionArticulacion`.
 */
class PccTbConsolidacionArticulacionSearch extends PccTbConsolidacionArticulacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Fecha_accion', 'Id_formador', 'Nombre1', 'Apellido1', 'IE', 'Mes', 'Avance_actores', 'Avance_transv', 'Insercion_PEI', 'Avance_biblio', 'Avance_otros', 'Adjuntos', 'Observaciones'], 'safe'],
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
        $query = PccTbConsolidacionArticulacion::find();

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
            'Fecha_accion' => $this->Fecha_accion,
        ]);

        $query->andFilterWhere(['ilike', 'Id', $this->Id])
            ->andFilterWhere(['ilike', 'Id_formador', $this->Id_formador])
            ->andFilterWhere(['ilike', 'Nombre1', $this->Nombre1])
            ->andFilterWhere(['ilike', 'Apellido1', $this->Apellido1])
            ->andFilterWhere(['ilike', 'IE', $this->IE])
            ->andFilterWhere(['ilike', 'Mes', $this->Mes])
            ->andFilterWhere(['ilike', 'Avance_actores', $this->Avance_actores])
            ->andFilterWhere(['ilike', 'Avance_transv', $this->Avance_transv])
            ->andFilterWhere(['ilike', 'Insercion_PEI', $this->Insercion_PEI])
            ->andFilterWhere(['ilike', 'Avance_biblio', $this->Avance_biblio])
            ->andFilterWhere(['ilike', 'Avance_otros', $this->Avance_otros])
            ->andFilterWhere(['ilike', 'Adjuntos', $this->Adjuntos])
            ->andFilterWhere(['ilike', 'Observaciones', $this->Observaciones]);

        return $dataProvider;
    }
}
