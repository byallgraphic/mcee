<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IsaIniciacionSensibilizacionArtisticaConsolidado;

/**
 * IsaIniciacionSensibilizacionArtisticaConsolidadoBuscar represents the model behind the search form of `app\models\IsaIniciacionSensibilizacionArtisticaConsolidado`.
 */
class IsaIniciacionSensibilizacionArtisticaConsolidadoBuscar extends IsaIniciacionSensibilizacionArtisticaConsolidado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_institucion', 'id_sede', 'estado', 'total_sesiones_realizadas', 'avance_por_mes', 'total_sesiones_aplazadas', 'total_sesiones_canceladas', 'vecinos', 'lideres_comunitarios', 'empresarios_comerciantes_microempresas', 'representantes_organizaciones_locales', 'asociaciones_grupos_comunitarios', 'otros_actores', 'actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'videos', 'otros_productos', 'id_actividad'], 'integer'],
            [['fecha'], 'safe'],
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
        $query = IsaIniciacionSensibilizacionArtisticaConsolidado::find();

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
            'fecha' => $this->fecha,
            'id_institucion' => $this->id_institucion,
            'id_sede' => $this->id_sede,
            'estado' => $this->estado,
            'total_sesiones_realizadas' => $this->total_sesiones_realizadas,
            'avance_por_mes' => $this->avance_por_mes,
            'total_sesiones_aplazadas' => $this->total_sesiones_aplazadas,
            'total_sesiones_canceladas' => $this->total_sesiones_canceladas,
            'vecinos' => $this->vecinos,
            'lideres_comunitarios' => $this->lideres_comunitarios,
            'empresarios_comerciantes_microempresas' => $this->empresarios_comerciantes_microempresas,
            'representantes_organizaciones_locales' => $this->representantes_organizaciones_locales,
            'asociaciones_grupos_comunitarios' => $this->asociaciones_grupos_comunitarios,
            'otros_actores' => $this->otros_actores,
            'actas' => $this->actas,
            'reportes' => $this->reportes,
            'listados' => $this->listados,
            'plan_trabajo' => $this->plan_trabajo,
            'formato_seguimiento' => $this->formato_seguimiento,
            'formato_evaluacion' => $this->formato_evaluacion,
            'fotografias' => $this->fotografias,
            'videos' => $this->videos,
            'otros_productos' => $this->otros_productos,
            'id_actividad' => $this->id_actividad,
        ]);

        return $dataProvider;
    }
}
