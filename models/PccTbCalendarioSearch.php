<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PccTbCalendario;

/**
 * PccTbCalendarioSearch represents the model behind the search form of `app\models\PccTbCalendario`.
 */
class PccTbCalendarioSearch extends PccTbCalendario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Fecha_captura', 'Nmero_de_identificacin_del_Tutor', 'Nombre', 'Apellido', 'Institucin_Educativa', 'Sede', 'Fecha_de_programacin', 'Hora_inicio', 'Hora_final', 'Actividad', 'Cantidad_de_refrigerios_requerid', 'Seguimiento_pedagogico', 'Estado_del_evento', 'Fecha_reprogramacion', 'Motivo_reprogramacion', 'Perfi', 'Lugar_reunion_as', 'Requiere_refrigerios', 'Taller', 'Laboratorio'], 'safe'],
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
        $query = PccTbCalendario::find();

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
            'Fecha_captura' => $this->Fecha_captura,
            'Fecha_de_programacin' => $this->Fecha_de_programacin,
            'Fecha_reprogramacion' => $this->Fecha_reprogramacion,
        ]);

        $query->andFilterWhere(['ilike', 'Id', $this->Id])
            ->andFilterWhere(['ilike', 'Nmero_de_identificacin_del_Tutor', $this->Nmero_de_identificacin_del_Tutor])
            ->andFilterWhere(['ilike', 'Nombre', $this->Nombre])
            ->andFilterWhere(['ilike', 'Apellido', $this->Apellido])
            ->andFilterWhere(['ilike', 'Institucin_Educativa', $this->Institucin_Educativa])
            ->andFilterWhere(['ilike', 'Sede', $this->Sede])
            ->andFilterWhere(['ilike', 'Hora_inicio', $this->Hora_inicio])
            ->andFilterWhere(['ilike', 'Hora_final', $this->Hora_final])
            ->andFilterWhere(['ilike', 'Actividad', $this->Actividad])
            ->andFilterWhere(['ilike', 'Cantidad_de_refrigerios_requerid', $this->Cantidad_de_refrigerios_requerid])
            ->andFilterWhere(['ilike', 'Seguimiento_pedagogico', $this->Seguimiento_pedagogico])
            ->andFilterWhere(['ilike', 'Estado_del_evento', $this->Estado_del_evento])
            ->andFilterWhere(['ilike', 'Motivo_reprogramacion', $this->Motivo_reprogramacion])
            ->andFilterWhere(['ilike', 'Perfi', $this->Perfi])
            ->andFilterWhere(['ilike', 'Lugar_reunion_as', $this->Lugar_reunion_as])
            ->andFilterWhere(['ilike', 'Requiere_refrigerios', $this->Requiere_refrigerios])
            ->andFilterWhere(['ilike', 'Taller', $this->Taller])
            ->andFilterWhere(['ilike', 'Laboratorio', $this->Laboratorio]);

        return $dataProvider;
    }
}
