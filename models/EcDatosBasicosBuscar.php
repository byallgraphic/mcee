<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EcDatosBasicos;

/**
 * EcDatosBasicosBuscar represents the model behind the search form of `app\models\EcDatosBasicos`.
 */
class EcDatosBasicosBuscar extends EcDatosBasicos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'estado'], 'integer'],
            [['profesional_campo', 'fecha_diligenciamiento'], 'safe'],
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
        $query = EcDatosBasicos::find();

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
            'fecha_diligenciamiento' => $this->fecha_diligenciamiento,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'profesional_campo', $this->profesional_campo]);

        return $dataProvider;
    }
}
