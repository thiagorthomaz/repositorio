<?php

class Ajax {

  public static function output($obj) {
    echo json_encode($obj);
  }

  /**
   *
   * @param Object $objeto
   * @return Array
   */
  public static function listaAtributos($objeto){
    $refection = new ReflectionClass($objeto);
    $lista_Atributos = array();
    foreach ($refection->getProperties() as $propriedade){
      $lista_Atributos[] = $propriedade->getName();
    }
    return $lista_Atributos;
  }

  /**
   * <code>
   *
   * echo Ajax::serializeObject($objeto);
   *
   * </code>
   *
   * @param Object $objeto
   * @return Json
   */
  public static function serializeObject($objeto){
    $json = array();
    foreach (self::listaAtributos($objeto) as $atributo){
      $json[$atributo]= utf8_encode(call_user_func(array($objeto, "get".ucfirst($atributo) )));
    }
    return json_encode($json);
  }

   /**
   * <code>
   *
   * echo Ajax::serializeObject($lista_objetos);
   *
   * @param Object $objeto
   * @return Array JsonObject
   */
  public static function serializeArrayObject($listaObjetos){
    $lista_json = array();
    foreach($listaObjetos as $objeto){
      $json = array();
      foreach (self::listaAtributos($objeto) as $atributo){
        $json[$atributo]= utf8_encode(call_user_func(array($objeto, "get".ucfirst($atributo) )));
      }
      $lista_json[] = $json;
    }
    return json_encode($lista_json);
  }
}

?>