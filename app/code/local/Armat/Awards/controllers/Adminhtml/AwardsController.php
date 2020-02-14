<?php
class Armat_Awards_Adminhtml_AwardsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Awards'));

        $this->loadLayout();
        $this->_setActiveMenu('armat_awards');
        $this->_addBreadcrumb(Mage::helper('armat_awards')->__('Awards'), Mage::helper('armat_awards')->__('Awards'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_title($this->__('Add new award'));
        $this->loadLayout();
        $this->_setActiveMenu('armat_awards');
        $this->_addBreadcrumb(Mage::helper('armat_awards')->__('Add new award'), Mage::helper('armat_awards')->__('Add new award'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__('Edit award'));

        $this->loadLayout();
        $this->_setActiveMenu('armat_awards');
        $this->_addBreadcrumb(Mage::helper('armat_awards')->__('Edit award'), Mage::helper('armat_awards')->__('Edit award'));
        $this->renderLayout();
    }

    public function deleteAction()
    {
        $tipId = $this->getRequest()->getParam('id', false);

        try {
            Mage::getModel('armat_awards/award')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('armat_awards')->__('Award successfully deleted'));

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }

        $this->_redirectReferer();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                //Featured save image
                unset($data['image']);
                if (isset($_FILES)) {
                    if ($_FILES['image']['name']) {
                        if ($this->getRequest()->getParam("id")) {
                            $model = Mage::getModel("armat_awards")->load($this->getRequest()->getParam("id"));
                            if ($model->getData('image')) {
                                $io = new Varien_Io_File();
                                $io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
                            }
                        }
                        $path = Mage::getBaseDir('media') . DS . 'armat' . DS . 'awards' . DS;
                        $uploader = new Varien_File_Uploader('image');
                        $uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(false);
                        $destFile = $path . $_FILES['image']['name'];
                        $filename = $uploader->getNewFileName($destFile);
                        $uploader->save($path, $filename);

                        $data['image'] = 'armat/awards/' . $filename;
                    }
                }

                Mage::getModel('armat_awards/award')
                    ->setData($data)
                    ->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('armat_awards')->__('Award successfully saved'));

            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }
        return $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('armat_awards/adminhtml_awards_grid')->toHtml()
        );
    }
}
