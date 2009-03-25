<?php
/*

  Plugin Name: Simple Meta Keywords
  Plugin URI: http://bluemonkcreative.com/
  Description: Simple Meta Ketwords will, on single (is_single()) posts, take any tags and add to the "keywords" meta tag in wp_head(). Otherwise, will use defaults set in plugin script.
  Version: 0.1.0
  Author: Bill Turner
  Author URI: http://bluemonkcreative.com/


  Copyright 2009 bluemonk creative (email : contact@bluemonkcreative.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

  // Default keywords to use if there are none
  // * SEPARATE KEYWORDS BY COMMA
  // * NO SPACES AROUND COMMA
  $default_keywords = "weblog,interesting,neat";
  
  function clean_tag($tag)
  {
    $tag = strtolower($tag);
    $tag = trim($tag);
    return $tag;
  }
  
  function simple_meta_keywords()
  {
    global $posts, $default_keywords;
    
    $keywords = explode(',', $default_keywords);
    
    if (is_single())
    {
      
      // pull the tags for the post
      $tags = get_the_tags($posts[0]->ID);
      
      if (!empty($tags))
      {
        
        foreach($tags as $tag)
        {
          $keywords[] = clean_tag($tag->name);
        }
        
        // remove dupes
        $keywords = array_unique($keywords);
      
      }
      
    }
    
    echo "<meta name=\"keywords\" content=\"" . implode(', ', $keywords) . "\" />\n";
    
  }

  add_action('wp_head', 'simple_meta_keywords');

?>
