<?php
phpinfo();

$width = 200;
$height = 400;
$bpp = 4;

// "Fudge Factor"
    $fudge = 1.2;
    
    if( !function_exists('memory_get_usage') )
    {
      $used = 5 * 1024 * 1024;
    }
    else
    {
      $used = memory_get_usage();
    }
    
    $limit = ini_get('memory_limit');
    if( !$limit )
    {
      $limit = 8 * 1024 * 1024;
    }

    else
    {
      $limit = ConvertBytes($limit);
    }

    $required = $width * $height * $bpp * $fudge;

    echo "Memory limit $limit <br/>";
    echo "Memory used $used <br/>";
    echo "Memory Required $required";
    
    
  function ConvertBytes($value)
  {
    if( is_numeric( $value ) )
    {
      return $value;
    }
    else
    {
      $value_length = strlen( $value );
      $qty = substr( $value, 0, $value_length - 1 );
      $unit = strtolower( substr( $value, $value_length - 1 ) );
      switch ( $unit )
      {
        case 'k':
          $qty *= 1024;
          break;
        case 'm':
          $qty *= 1048576;
          break;
        case 'g':
          $qty *= 1073741824;
          break;
      }
      return $qty;
    }
  }
    
    
?>