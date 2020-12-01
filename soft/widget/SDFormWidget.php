<?php 


namespace soft\widget;

use Yii;
use yii\base\Model;
use soft\helpers\SArray;


/**
	 * Extended widget of DynamicFormWidget
	 */

class SDFormWidget  extends Model
{

		// parent model
	public $model;

		// child models
	public $models;

		// scenarios
	public $modelScenario;
	public $modelsScenario;

	public $parentAttribute = 'id';
	public $childAttribute;

		// set attributes for model and models
	public $modelAttributes = [];
	public $modelsAttributes = [];

		// child models classname
	public $modelClass;

	public $sortAttribute = false;

	public $deleteOldModels = false;

	public $successMessage = "Ma'lumotlar muvaffaqiyatli saqlandi!";
	public $errorMessage = "Ma'lumotlarni saqlashda xatolik yuz berdi!";


        /**
	     * Creates and populates a set of models.
	     * @return array
	     */

        public function createMultiple()
        {
        	$model    = new $this->modelClass;
        	$formName = $model->formName();
        	$post     = \Yii::$app->request->post($formName);
        	$models   = [];

        	if (!empty($this->models)) {
        		$keys = array_keys(SArray::map($this->models, 'id', 'id'));
        		$this->models = array_combine($keys, $this->models);
        	}

        	if ($post && is_array($post)) {
        		foreach ($post as $i => $item) {
        			if (isset($item['id']) && !empty($item['id']) && isset($this->models[$item['id']])) {
        				$models[] = $this->models[$item['id']];
        			} else {
        				$models[] = new $this->modelClass;
        			}
        		}
        	}

        	unset($model, $formName, $post);
        	return $models;
        }


        public function save(){

        	$request = Yii::$app->request;

        	if ($request->post()) {

        		if ($this->hasModel) {
        			$this->model->load($request->post());
        		}

                $oldIDs = SArray::map($this->models, 'id', 'id');
                $this->models = $this->createMultiple();
                Model::loadMultiple($this->models, $request->post());
                $this->deleteOldIds($oldIDs);
                $this->setSort();
        		$this->setAttributeValues();
        		$result = $this->saveModels();

        		if ($result && $this->successMessage !== false) {
        			Yii::$app->session->setFlash('success', $this->successMessage);
        		}

        		if (!$result && $this->errorMessage !== false) {
        			Yii::$app->session->setFlash('error', $this->errorMessage);
        		}

        		return $result;
        	}

        	return false;
        }

        // set sorting for child models
        public function setSort(){
        	
        	if ($this->sortAttribute !== false) {
        		$sortAttribute = $this->sortAttribute;
        		foreach ($this->models as $index => $model) {
        			$model->$sortAttribute = $index;
        		} 
        	}
        }

        public function setAttributeValues(){
        
        	// set parent model attributes
        	if ($this->hasModel) {
        		if ($this->modelScenario) {
        			$this->modelAttributes['scenario'] = $this->modelScenario;
        		}
        		$this->model->setAttributes($this->modelAttributes);
        	} 

            // set child multiple models attributes

        	if ($this->modelsScenario) {
        		$this->modelsAttributes['scenario'] = $this->modelsScenario;
        	}

        	foreach ($this->models as $model) {
        		$model->setAttributes($this->modelsAttributes);
        	}
                
        }

        public function deleteOldIds($oldIDs){
        
            if ($this->deleteOldModels) {
            	$deletedIDs = array_diff($oldIDs, array_filter(SArray::map($this->models, 'id', 'id')));
            	if (!empty($deletedIDs)) {
            		foreach ($deletedIDs as $id) {
            			$model = $this->modelClass::findOne($id);
            			if ($model != null && $model->isDeletable) {
            				$model->delete();
            			}
            		}
            	}
            }
                
        }

          //  validate and save all models
        
        public function saveModels(){

        	$valid = true;

        	if ($this->hasModel) {
        		$valid = $this->model->validate();
        	}

        	$valid = Model::validateMultiple($this->models) && $valid;

        	if ($valid) {
        		$transaction = \Yii::$app->db->beginTransaction();

        		try {

        			$flag = true;

        			// save parent model
        			if ($this->hasModel) {
        				$flag = $this->model->save(false);
        			}

        			if ($flag) {

        				// save child models
        				foreach ($this->models as $model) {
        					if (!($flag = $model->save(false))) {
        						$transaction->rollBack();
        						break;
        					}
        				}	
        			}
        			
        			if ($flag) {
        				$transaction->commit();

        				// if success return true
        				return true;
        			}

        		} catch (Exception $e) {
        			$transaction->rollBack();
        		}
        	}

        	return false;
        }


        /**
         * Check if the widget has single parent model
        */
        
        public function getHasModel(){
        
            return $this->model != null; 
                
        }

    }

   ?>