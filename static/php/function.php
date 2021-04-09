<?
function wysiwygClean($str)
{
  while(ord(substr($str, 0, 1)) == '9' || 
        ord(substr($str, 0, 1)) == '10' || 
        ord(substr($str, 0, 1)) == '13' || 
        ord(substr($str, 0, 1)) == '32'
       )
  {
    $str = substr($str, 1);
  }
  if(!empty($str))
  {
    while(ord(substr($str, strlen($str) - 1)) == '9' || 
          ord(substr($str, strlen($str) - 1)) == '10' || 
          ord(substr($str, strlen($str) - 1)) == '13' || 
          ord(substr($str, strlen($str) - 1)) == '32'
         )
    {
      $str = substr($str, 0, strlen($str) - 1);
    }
  }
  return $str;
}
function wrap_span($str)
{
    // Define source
    $source = $str;

    // Create DOM document and load HTML string, hinting that it is UTF-8 encoded.
    // We need a root element for this so we wrap the source in a temporary <div>.
    $hint = '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
    $dom = new DOMDocument();
    $dom->loadHTML($hint . "<div>" . $source . "</div>");

    // Get contents of temporary root node
    $root = $dom->getElementsByTagName('div')->item(0);

    // Loop through children
    $next = $root->firstChild;
    while ($node = $next) {
        $next = $node->nextSibling; // Save for next while iteration
        // We are only interested in text nodes (not <br/> etc)
        if ($node->nodeType == XML_TEXT_NODE) {
            // Wrap each character of the text node (e.g. "Hi ") in a <span> of
            // its own, e.g. "<span>H</span><span>i</span><span> </span>"
            foreach (preg_split('/(?<!^)(?!$)/u', $node->nodeValue) as $char) {
                // var_dump(ord($char));
                $span = $dom->createElement('span', $char);
                $span->setAttribute('class', 'gradient-pixel');
                $root->insertBefore($span, $node);
            }
            // Drop text node (e.g. "Hi ") leaving only <span> wrapped chars
            $root->removeChild($node);
        }
        else if($node->nodeType == 1)
        {
            wrap_span($node->textContent);
        }
    }

    // Back to string via SimpleXMLElement (so that the output is more similar to
    // the source than would be the case with $root->C14N() etc), removing temporary
    // root <div> element and space-only spans as well.
    $withSpans = simplexml_import_dom($root)->asXML();
    $withSpans = preg_replace('#^<div>|</div>$#', '', $withSpans);
    $withSpans = preg_replace('#<span> </span>#', ' ', $withSpans);

    echo $withSpans, PHP_EOL;
    // return $withSpans;
}

?>