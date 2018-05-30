<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property string $nombrep
 * @property string $precio_sugerido
 * @property int $id
 *
 * @property Detallepedido[] $detallepedidos
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio_sugerido'], 'number'],
            [['nombrep'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nombrep' => 'Nombre del producto',
            'precio_sugerido' => 'Precio Sugerido',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::className(), ['productoid' => 'id']);
    }
}
