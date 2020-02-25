<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lectores;

/**
 * LectoresSearch represents the model behind the search form of `app\models\Lectores`.
 */
class LectoresSearch extends Lectores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['numero', 'nombre', 'direccion', 'poblacion', 'provincia', 'fecha_nac', 'created_at'], 'safe'],
            [['codpostal_id'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Lectores::find();

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
            'codpostal_id' => $this->codpostal_id,
            'fecha_nac' => $this->fecha_nac,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'numero', $this->numero])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'poblacion', $this->poblacion])
            ->andFilterWhere(['ilike', 'provincia', $this->provincia]);

        return $dataProvider;
    }
}
