<?php

/**
 * menu module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage menu
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMenuGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%credencial%% - %%modulo%% - %%descripcion%% - %%parametro%% - %%idgrupomenu%% - %%orden%% - %%idsistema%% - %%created_at%% - %%updated_at%% - %%created_by%% - %%updated_by%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Menu List';
  }

  public function getEditTitle()
  {
    return 'Edit Menu';
  }

  public function getNewTitle()
  {
    return 'New Menu';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'credencial',  2 => 'modulo',  3 => 'descripcion',  4 => 'parametro',  5 => 'idgrupomenu',  6 => 'orden',  7 => 'idsistema',  8 => 'created_at',  9 => 'updated_at',  10 => 'created_by',  11 => 'updated_by',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'credencial' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'modulo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'descripcion' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'parametro' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'idgrupomenu' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'orden' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'idsistema' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'created_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'updated_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'credencial' => array(),
      'modulo' => array(),
      'descripcion' => array(),
      'parametro' => array(),
      'idgrupomenu' => array(),
      'orden' => array(),
      'idsistema' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'created_by' => array(),
      'updated_by' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'credencial' => array(),
      'modulo' => array(),
      'descripcion' => array(),
      'parametro' => array(),
      'idgrupomenu' => array(),
      'orden' => array(),
      'idsistema' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'created_by' => array(),
      'updated_by' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'credencial' => array(),
      'modulo' => array(),
      'descripcion' => array(),
      'parametro' => array(),
      'idgrupomenu' => array(),
      'orden' => array(),
      'idsistema' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'created_by' => array(),
      'updated_by' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'credencial' => array(),
      'modulo' => array(),
      'descripcion' => array(),
      'parametro' => array(),
      'idgrupomenu' => array(),
      'orden' => array(),
      'idsistema' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'created_by' => array(),
      'updated_by' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'credencial' => array(),
      'modulo' => array(),
      'descripcion' => array(),
      'parametro' => array(),
      'idgrupomenu' => array(),
      'orden' => array(),
      'idsistema' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'created_by' => array(),
      'updated_by' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'menuForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'menuFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
