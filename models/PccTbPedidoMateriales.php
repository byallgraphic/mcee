<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_PedidoMateriales".
 *
 * @property string $IdAccion
 * @property string $FechaAccion
 * @property string $IdFormador
 * @property string $NombreFormador
 * @property string $ApellidoFormador
 * @property string $emailformador
 * @property string $MesMateriales
 * @property string $DestinoMateriales
 * @property string $CantidadMateriales
 * @property string $Producto1
 * @property string $Descripcion1
 * @property string $Cantidad1
 * @property string $Producto2
 * @property string $Descripcion2
 * @property string $Cantidad2
 * @property string $Producto3
 * @property string $Descripcion3
 * @property string $Cantidad3
 * @property string $Producto4
 * @property string $Descripcion4
 * @property string $Cantidad4
 * @property string $Producto5
 * @property string $Descripcion5
 * @property string $Cantidad5
 * @property string $Producto6
 * @property string $Descripcion6
 * @property string $Cantidad6
 * @property string $Producto7
 * @property string $Descripcion7
 * @property string $Cantidad7
 * @property string $Producto8
 * @property string $Descripcion8
 * @property string $Cantidad8
 * @property string $Producto9
 * @property string $Descripcion9
 * @property string $Cantidad9
 * @property string $Producto10
 * @property string $Descripcion10
 * @property string $Cantidad10
 */
class PccTbPedidoMateriales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_PedidoMateriales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FechaAccion'], 'safe'],
            [['IdAccion'], 'string', 'max' => 30],
            [['IdFormador', 'CantidadMateriales', 'Cantidad1', 'Cantidad2', 'Cantidad3', 'Cantidad4', 'Cantidad6', 'Cantidad7', 'Cantidad8', 'Cantidad9', 'Cantidad10'], 'string', 'max' => 320],
            [['NombreFormador', 'ApellidoFormador', 'emailformador', 'MesMateriales', 'DestinoMateriales', 'Producto1', 'Descripcion1', 'Producto2', 'Descripcion2', 'Producto3', 'Descripcion3', 'Producto4', 'Descripcion4', 'Producto5', 'Descripcion5', 'Cantidad5', 'Producto6', 'Descripcion6', 'Producto7', 'Descripcion7', 'Producto8', 'Descripcion8', 'Producto9', 'Descripcion9', 'Producto10', 'Descripcion10'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAccion' => 'Id Accion',
            'FechaAccion' => 'Fecha Accion',
            'IdFormador' => 'Id Formador',
            'NombreFormador' => 'Nombre Formador',
            'ApellidoFormador' => 'Apellido Formador',
            'emailformador' => 'Emailformador',
            'MesMateriales' => 'Mes Materiales',
            'DestinoMateriales' => 'Destino Materiales',
            'CantidadMateriales' => 'Cantidad Materiales',
            'Producto1' => 'Producto1',
            'Descripcion1' => 'Descripcion1',
            'Cantidad1' => 'Cantidad1',
            'Producto2' => 'Producto2',
            'Descripcion2' => 'Descripcion2',
            'Cantidad2' => 'Cantidad2',
            'Producto3' => 'Producto3',
            'Descripcion3' => 'Descripcion3',
            'Cantidad3' => 'Cantidad3',
            'Producto4' => 'Producto4',
            'Descripcion4' => 'Descripcion4',
            'Cantidad4' => 'Cantidad4',
            'Producto5' => 'Producto5',
            'Descripcion5' => 'Descripcion5',
            'Cantidad5' => 'Cantidad5',
            'Producto6' => 'Producto6',
            'Descripcion6' => 'Descripcion6',
            'Cantidad6' => 'Cantidad6',
            'Producto7' => 'Producto7',
            'Descripcion7' => 'Descripcion7',
            'Cantidad7' => 'Cantidad7',
            'Producto8' => 'Producto8',
            'Descripcion8' => 'Descripcion8',
            'Cantidad8' => 'Cantidad8',
            'Producto9' => 'Producto9',
            'Descripcion9' => 'Descripcion9',
            'Cantidad9' => 'Cantidad9',
            'Producto10' => 'Producto10',
            'Descripcion10' => 'Descripcion10',
            'Cantidad10' => 'Cantidad10',
        ];
    }
}
