<?php

class Socialdna_Form_Decorator_SDivDivDivWrapper extends Zend_Form_Decorator_Abstract
{
    /**
     * Default placement: surround content
     * @var string
     */
    protected $_placement = null;

    /**
     * Render
     *
     * Renders as the following:
     * <dt></dt>
     * <dd>$content</dd>
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $elementName = $this->getElement()->getName();
        
        $test = '';

        return
'<table cellpadding=0 cellpadding=0 width="100%">
<tr>
<td>'
. $content
.'</td>
<td>xx'
. $test
.'</td>
</tr>
</table>';
    
          //'<xdiv id="' . $elementName . '-wrapper" class="form-wrapper">'.
          //'<div id="' . $elementName . '-label" class="form-label">&nbsp;</div>' .
          //'<div id="' . $elementName . '-element" class="form-element">' . $content . '</div>'.
          //'</xdiv>';
    }
}
