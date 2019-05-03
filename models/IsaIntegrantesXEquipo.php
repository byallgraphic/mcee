<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.integrantes_x_equipo".
 *
 * @property string $id
 * @property string $id_equipo_campo
 * @property string $id_perfil_persona_institucion
 * @property string $estado
 */
class IsaIntegrantesXEquipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.integrantes_x_equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_equipo_campo', 'id_perfil_persona_institucion', 'estado'], 'default', 'value' => null],
            [['id_equipo_campo', 'id_perfil_persona_institucion', 'estado'], 'integer'],
            [['id_equipo_campo'], 'exist', 'skipOnError' => true, 'targetClass' => IsaEquiposCampo::className(), 'targetAttribute' => ['id_equipo_campo' => 'id']],
            [['id_perfil_persona_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_perfil_persona_institucion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_equipo_campo' => 'Id Equipo Campo',
            'id_perfil_persona_institucion' => 'Id Perfil Persona Institucion',
            'estado' => 'Estado',
        ];
    }
}
