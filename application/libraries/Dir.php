<?php if (!@defined('BASEPATH')) exit('No direct script access allowed');

class Dir {
    
 
  function delete($path)
    {
      if($path != './Files/' && $path != './Files' && $path != '/Files/' && $path != '/Files' && $path != 'Files')
      {
          $files=@glob($path.'/*');
          
          if(is_array($files))
            foreach($files as $files_dir)
            {
                if(is_dir($files_dir)) 
                    $this->delete($files_dir);
                else 
                    @unlink($files_dir);
            }
          
            @rmdir($path);
          
      }
 }

}
