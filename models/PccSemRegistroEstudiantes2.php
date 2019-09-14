<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Sem_Registro_Estudiantes2".
 *
 * @property string $ID
 * @property string $Rol
 * @property string $Fecha_registro
 * @property string $Validar
 * @property string $Fecha_ingreso
 * @property string $Tipo_documento_id
 * @property string $Numero_id
 * @property string $Codigo_Micomunidadesescuela
 * @property string $Tiene_F_nacimiento
 * @property string $Fecha_de_nacimiento
 * @property string $Grupo_etareo
 * @property string $Sexo
 * @property string $Primer_nombre
 * @property string $Segundo_nombre
 * @property string $Primer_apellido
 * @property string $Segundo_apellido
 * @property string $Direccion
 * @property string $Zona
 * @property string $Corregimiento
 * @property string $Sector_vereda
 * @property string $Num_id_territorio
 * @property string $Departamento
 * @property string $Ciudad
 * @property string $Estrato
 * @property string $Barrio
 * @property string $Distribucion_zonal_COMCE
 * @property string $Comuna
 * @property string $Email
 * @property string $Institucion_Educativa
 * @property string $Sede
 * @property string $Direccion_IE
 * @property string $Barrio_IE
 * @property string $Grado
 * @property string $Grupo
 * @property string $Grupo_etnico
 * @property string $Otro_grupo_etnico
 * @property string $Discapacidad
 * @property string $Desplazado
 * @property string $Victima
 * @property string $Num_id_tutor
 * @property string $Primer_nombre_tutor
 * @property string $Primer_apellido_tutor
 * @property string $telefono
 * @property string $Estado
 */
class PccSemRegistroEstudiantes2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Sem_Registro_Estudiantes2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_registro', 'Fecha_ingreso', 'Fecha_de_nacimiento'], 'safe'],
            [['ID'], 'string', 'max' => 10],
            [['Rol', 'Validar', 'Tipo_documento_id', 'Codigo_Micomunidadesescuela', 'Grupo_etareo', 'Sexo', 'Primer_nombre', 'Segundo_nombre', 'Primer_apellido', 'Segundo_apellido', 'Direccion', 'Zona', 'Corregimiento', 'Sector_vereda', 'Num_id_territorio', 'Departamento', 'Ciudad', 'Estrato', 'Barrio', 'Distribucion_zonal_COMCE', 'Comuna', 'Email', 'Institucion_Educativa', 'Sede', 'Direccion_IE', 'Barrio_IE', 'Grado', 'Grupo', 'Grupo_etnico', 'Otro_grupo_etnico', 'Discapacidad', 'Desplazado', 'Victima', 'Num_id_tutor', 'Primer_nombre_tutor', 'Primer_apellido_tutor', 'telefono', 'Estado'], 'string', 'max' => 255],
            [['Numero_id'], 'string', 'max' => 320],
            [['Tiene_F_nacimiento'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Rol' => 'Rol',
            'Fecha_registro' => 'Fecha Registro',
            'Validar' => 'Validar',
            'Fecha_ingreso' => 'Fecha Ingreso',
            'Tipo_documento_id' => 'Tipo Documento ID',
            'Numero_id' => 'Numero ID',
            'Codigo_Micomunidadesescuela' => 'Codigo  Micomunidadesescuela',
            'Tiene_F_nacimiento' => 'Tiene  F Nacimiento',
            'Fecha_de_nacimiento' => 'Fecha De Nacimiento',
            'Grupo_etareo' => 'Grupo Etareo',
            'Sexo' => 'Sexo',
            'Primer_nombre' => 'Primer Nombre',
            'Segundo_nombre' => 'Segundo Nombre',
            'Primer_apellido' => 'Primer Apellido',
            'Segundo_apellido' => 'Segundo Apellido',
            'Direccion' => 'Direccion',
            'Zona' => 'Zona',
            'Corregimiento' => 'Corregimiento',
            'Sector_vereda' => 'Sector Vereda',
            'Num_id_territorio' => 'Num Id Territorio',
            'Departamento' => 'Departamento',
            'Ciudad' => 'Ciudad',
            'Estrato' => 'Estrato',
            'Barrio' => 'Barrio',
            'Distribucion_zonal_COMCE' => 'Distribucion Zonal  Comce',
            'Comuna' => 'Comuna',
            'Email' => 'Email',
            'Institucion_Educativa' => 'Institucion  Educativa',
            'Sede' => 'Sede',
            'Direccion_IE' => 'Direccion  Ie',
            'Barrio_IE' => 'Barrio  Ie',
            'Grado' => 'Grado',
            'Grupo' => 'Grupo',
            'Grupo_etnico' => 'Grupo Etnico',
            'Otro_grupo_etnico' => 'Otro Grupo Etnico',
            'Discapacidad' => 'Discapacidad',
            'Desplazado' => 'Desplazado',
            'Victima' => 'Victima',
            'Num_id_tutor' => 'Num Id Tutor',
            'Primer_nombre_tutor' => 'Primer Nombre Tutor',
            'Primer_apellido_tutor' => 'Primer Apellido Tutor',
            'telefono' => 'Telefono',
            'Estado' => 'Estado',
        ];
    }
}
