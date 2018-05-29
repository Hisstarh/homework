<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\FileHelper;
use common\models\Db;
class DbController extends Controller{
    //Путь к файлам БД по-умолчанию
    public $dumpPath = '@common/db/dump';
    public function actionIndex($path = null){
        //Получаем массива путей к файлам с дампом БД (.sql)
        $path = FileHelper::normalizePath(Yii::getAlias($this->dumpPath));
        $files = FileHelper::findFiles($path, ['only' => ['*.sql'], 'recursive' => FALSE]);
        $model = new Db();
        //Метод формирует массив в нужный для виджета GridView формат с пагинацией
        $dataProvider = $model->getFiles($files);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionImport($path) {
        $model = new Db();
        //Метод делает импорт дампа БД
        $model->import($path);

    }
    public function actionExport($path = null) {
        $path = $path ? : $this->dumpPath;
        $model = new Db();
        //Метод экспортирует данные из БД в указанную папку
        $model->export($path);
    }
    public function actionDelete($path) {
        $model = new Db();
        //Метод удаляет дамп БД
        $model->delete($path);
    }
    //Доступ только для админа
//    public function beforeAction($action)
//    {
//        $user = \Yii::$app->user;
//        dump($user);
//        if (parent::beforeAction($action)) {
//            if (!\Yii::$app->user->can('admin')) {
//                throw new \yii\web\ForbiddenHttpException('Доступ закрыт.');
//            }
//            return true;
//        } else {
//            return false;
//        }
//    }
}