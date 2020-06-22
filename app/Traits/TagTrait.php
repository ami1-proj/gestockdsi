<?php

namespace App\Traits;
use App\Tag;

trait TagTrait {

   /**
    * Renvoi une liste de noms de tags a partir d une liste d ids de tags
    * @param  array $tags_arr liste d ids de tags contenu dans un tableau
    * @return string            la liste de noms de tags ou une variable vide
    */
  public function setTags($tags_arr) : string {
      $tags = "";

      if ((is_array($tags_arr)) ) {
          foreach ($tags_arr as $tag) {
              $tag = Tag::find($tag);
              if ($tags == "") {
                  $tags = "" . $tag->name;
              } else {
                  $tags = $tags . "," . $tag->name;
              }
          }

          $tags = $tags . "";
      }

      return $tags;
  }

  /**
   * Renvoi une liste d objet Tag a partir d un string de noms de tags delemites
   * @param  string $tags_str liste de noms de tags delimite
   * @return array           liste d objets Tag
   */
  public function getTags($tags_str)
  {
      $tags = "";

      $tags_arr = explode(",", $tags_str);
      $tags = Tag::whereIn('name', $tags_arr)->get()->pluck('name', 'id');

      return $tags;
  }

  public function formatTags($formInput)
  {
      if (array_key_exists('tags', $formInput)) {
          $formInput['tags'] = $this->setTags($formInput['tags']);
      } else {
          $formInput['tags'] = '';
      }

      return $formInput;
  }

}
