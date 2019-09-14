<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_accion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $estado
 *
 * @property ActividadesIeo[] $actividadesIeos
 * @property DocumentosReconocimiento[] $documentosReconocimientos
 * @property Producto[] $productos
 */
class PlanAccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.plan_accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividadesIeos()
    {
        return $this->hasMany(ActividadesIeo::className(), ['plan_accion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentosReconocimientos()
    {
        return $this->hasMany(DocumentosReconocimiento::className(), ['plan_accion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['plan_accion_id' => 'id']);
    }
}
