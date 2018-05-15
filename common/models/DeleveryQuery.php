<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Delevery]].
 *
 * @see Delevery
 */
class DeleveryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Delevery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Delevery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
