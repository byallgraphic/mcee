<?php

/**********
Versión: 001
Fecha: 2018-10-01
Desarrollador: Edwin MG
Descripción: Modelo Documentos Gestion Comunitaria Buscar
---------------------------------------
*/

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentosGestionComunitaria;

/**
 * DocumentosInstanciasInstitucionalesBuscar represents the model behind the search form of `app\models\DocumentosGestionComunitaria`.
 */
class DocumentosGestionComunitariaBuscar extends DocumentosGestionComunitaria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tipo_documento', 'id_instituciones', 'estado'], 'integer'],
            [['ruta'], 'safe'],
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
        $query = DocumentosGestionComunitaria::find();

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
            'id_tipo_documento' => $this->id_tipo_documento,
            'id_instituciones' => $this->id_instituciones,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['ilike', 'ruta', $this->ruta]);

        return $dataProvider;
    }
}
