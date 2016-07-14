<?php

namespace app\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string | integer $user the user ID
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['proposal']) ? $params['proposal']->user_id == $user : false;

        // if(isset($params['model'])) { // Directly specify the model you plan to use via param
        //     $model = $params['model'];
        // } else { // Use the controller findModel method to get the model - this is what execute via the behaviour/rules
        //     $id = \Yii::$app->request->get('id'); // Note, this is an assumption on your url structure.
        //     $model = \Yii::$app->controller->findUserModel($id); // Note, this only works if you change findModel to be a public
        // }
        //
        // return $model->user_id == $user;
    }
}
