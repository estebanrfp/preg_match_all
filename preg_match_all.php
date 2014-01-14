<?php 
function filtro($txt){
	
	preg_match_all('~\[tube](.[^>]*)\[/tube]~', $txt, $match_link);
	preg_match_all('~\[swf](.[^>]*)\[/swf]~', $txt, $match_swf_link);
	preg_match_all('~\[unity](.[^>]*)\[/unity]~', $txt, $match_unity_link);
	preg_match_all('~\[slider](.[^>]*)\[/slider]~', $txt, $match_slider_link);
	preg_match_all('~\[github](.[^>]*)\[/github]~', $txt, $match_github_link);
	
        
//tube         
    $NumberOfVid = count($match_link[1]);
    if ( $NumberOfVid > 0 ){
           for ( $i=0; $i < count($match_link[1]) ; $i++ ) {
           	    
				 $tube =  $match_link[1][$i];      
	             preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $tube, $match_id);
                 $video_id = $match_id[1];
			   
			   $search[$i]  = '[tube]'.$tube.'[/tube]';
               $replace[$i] = '<div align="center"><iframe width="90%" height="360" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="1" allowfullscreen></iframe></div>';				
	        };//end for 
	 }

//swf
    $NumberOfSwf = count($match_swf_link[1]);
    if ( $NumberOfSwf > 0 ){
		
           for ( $i=0; $i < count($match_swf_link[1]) ; $i++ ) {
           	    
			   $swf =  $match_swf_link[1][$i];      
			   
			   $search_swf[$i]  = '[swf]'.$swf.'[/swf]'; 
			   $replace_swf[$i] = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-4… codebase="http://download.macromedia.com… width="680" height="360" title="test">
<param name="movie" value="'.$swf.'" />
<param name="quality" value="high" />
<embed src="'.$swf.'" quality="high" pluginspage="http://www.macromedia.com/g… type="application/x-shockwave-flash" width="680" height="360"></embed>
</object>';
					
	        };//end for 
	 }	 


//unity
    $NumberOfUnity = count($match_unity_link[1]);
	
    if ( $NumberOfUnity > 0 ){
		
           for ( $i=0; $i < count($match_unity_link[1]) ; $i++ ) {
           	    
			   $unity =  $match_unity_link[1][$i];      
			   
			   $search_unity[$i]  = '[unity]'.$unity.'[/unity]'; 
			   $replace_unity[$i] = '<object id="UnityObject" classid="clsid:444785F1-DE89-4295-863A-D46C3A781394"
    width="100%" height="360"
    codebase="http://webplayer.unity3d.com/download_webplayer/UnityWebPlayer.cab#version=2,0,0,0">
    <param name="'.$unity.'" value="test" />
    <embed id="UnityEmbed" src="'.$unity.'" width="680" height="360"
        type="application/vnd.unity" pluginspage="http://www.unity3d.com/unity-web-player-2.x" />
</object>';
					
	        };//end for 
	 }	 
	 	

//slider
// converts pure string into a trimmed keyed array
function string2KeyedArray($string, $delimiter = ',', $kv = '=') {
  if ($a = explode($delimiter, $string)) { // create parts
    foreach ($a as $s) { // each part
      if ($s) {
        if ($pos = strpos($s, $kv)) { // key/value delimiter
          $ka[trim(substr($s, 0, $pos))] = trim(substr($s, $pos + strlen($kv)));
        } else { // key delimiter not found
          $ka[] = trim($s);
        }
      }
    }
    return $ka;
  }
} // string2KeyedArray

    $NumberOfSlider = count($match_slider_link[1]);
    if ( $NumberOfSlider > 0 ){
		
           for ( $i=0; $i < count($match_slider_link[1]) ; $i++ ) {
           	    
			   $slider =  $match_slider_link[1][$i];
			   
			   $str = explode("|",$slider);
			   
	      
			   
			   $search_slider[$i]  = '[slider]'.$slider.'[/slider]'; 
			   $replace_slider[$i] .= '<style>.peKenBurns {width: 100%; height: 360px; top: 20px; margin: 0 auto; } </style>
                                       <div class="peKenBurns" data-logo="disabled">';
									  
			   foreach ($str as $valor) {
				   

				   
				   $str2 = explode(",",$valor);
				   $str3 = explode("=",$str2[0]);
	                
				   $str4 = string2KeyedArray($valor);

                    
				 
				   
				  
                   if($str3[0] == "image"){
					   

				         $replace_slider[$i] .= '<div data-delay="5" data-thumb="'.$str4["image"].'">
					                             <img src="/../banner/img/blank.png" data-src="'.$str4["image"].'" alt="'.$str4["alt"].'" />
				                                 <h2>'.$str4["texto"].'</h2>
			                                     </div>';
				   }
                   if($str3[0] == "video"){
				         $replace_slider[$i] .= '<div data-delay="5" data-thumb="'.$str4["image"].'">
				                                 <a class="video hd autoplay loop skiptonext" href="'.$str4["video"].'"><img src="/../banner/img/blank.png" data-src="'.$str4["image"].'" alt="'.$str4["alt"].'" /></a>
				                                 <h2>'.$str4["texto"].'</h2>
			                                     </div>';
				   }				   
			   }   
			   
			   $replace_slider[$i] .= '</div>';
		
					
	        };//end for 
	 }	

    $NumberOfGithub = count($match_github_link[1]);
    if ( $NumberOfGithub > 0 ){
		
           for ( $i=0; $i < count($match_github_link[1]) ; $i++ ) {
           	    
			   $github =  $match_github_link[1][$i];
			 
			   
			   $str = string2KeyedArray($github);
	      
			   
			   $search_github[$i]  = '[github]'.$github.'[/github]'; 
			   $replace_github[$i] = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                                       <script src="http://desarrolloactivo.com/js/repo.min.js"></script> 
									   <hr>                           
	                                   <script type="text/javascript"> 
                                       $('."body".').repo({ user: '.$str["usuario"].', name: '.$str["project"].'});                                     
                                       </script>';
		
					
	        };//end for 
	 }	

	$texto = str_replace($search, $replace, $txt); 
	$texto2 = str_replace($search_swf, $replace_swf, $texto); 
	$texto3 = str_replace($search_unity, $replace_unity, $texto2); 
	$texto4 = str_replace($search_slider, $replace_slider, $texto3);
	$texto5 = str_replace($search_github, $replace_github, $texto4); 
	 		
    //return $texto5;	
	return $texto5;
	}//end function

	
?>
