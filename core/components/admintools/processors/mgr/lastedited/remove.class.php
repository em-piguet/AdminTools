<?php
/**
 * Remove element from the last edited list
 * @deprecated Not used
 */
class ElementLogRemoveProcessor extends modProcessor {
    public $objectType = 'admintools';
//	public $classKey = '';
    public $languageTopics = array('admintools:default');
    public $permission = 'remove_led_elements';
    /**
     * @return boolean
     */
    public function initialize() {
        $path = $this->modx->getOption('admintools_core_path', null, $this->modx->getOption('core_path') . 'components/admintools/') . 'model/admintools/';
        $this->modx->getService('admintools', 'AdminTools', $path, array());
        return ($this->modx->admintools instanceof AdminTools);
    }
    /**
     * @return mixed
     */
    public function process() {
        $ids = $this->getProperty('ids');
        $ids = $this->modx->fromJSON($ids);

        $elements = $this->modx->admintools->getFromCache('element_log', 'elementlog/');
        foreach ($ids as $id) {
            unset($elements[$id]);
        }

        $this->modx->admintools->saveToCache($elements, 'element_log', 'elementlog/');
        return $this->success();
    }
}
return 'ElementLogRemoveProcessor';