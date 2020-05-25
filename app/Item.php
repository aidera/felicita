<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  //Отдает объект с ID категориями
  public function getCategoryID(){
    $categories = explode(", ", $this->category);
    
    $categoryArray = [];

    foreach($categories as $category){
      $newCategory = Category::where('id', $category)->select('id')->first();
      array_push($categoryArray, $newCategory);
    } 

    return $categoryArray;

      
  }

  //Отдает объект со всеми параметрами категорий
  public function getCategory(){
    $categories = explode(", ", $this->category);
    
    $categoryArray = [];

    foreach($categories as $category){
      $newCategory = Category::where('id', $category)->first();
      array_push($categoryArray, $newCategory);
    } 

    return $categoryArray;

      
  }
}
