<?

// set up
$imgs_id = 21;

$texts_id = 19; //en
if ($uri[1] == "es") {
  $texts_id = 20; //es
}
$children_text = $oo->children($texts_id);
$children_img = $oo->children($imgs_id);
shuffle($children_img);

$children = [];
$skip_next = false;

// randomly insert images and process for _ (news) entry
for ($i = 0; $i < count($children_text); $i++) {

  // insert image every other or every two
  if (!$skip_next) {
    $children []= array_pop($children_img);
    if (rand(0,1) == 0)
      $skip_next = true;
  } else {
    $skip_next = false;
  }

  // check for any special processing
  if (substr($children_text[$i]['name1'], 0, 1) == "_")
    $children []= processNews($children_text[$i]);
  else
    $children []= $children_text[$i];
}

$length = count($children);
$idx = 0;

// round to nearest 5
function roundUpToAny($n,$x=5) {
    return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
}

function getRandOffset($idx) {
  if ($idx == 0) {
    return 0;
  } else {
    return roundUpToAny(rand(10, 35));
  }
}

function getRandWidth($idx) {
  return roundUpToAny(rand(10, 35));
}

function getMeta($child, $media) {
  $out = [];

  $out []= 'Modified ' . $child["modified"];
  if ($media) {
    $out []= basename(m_root($media[0]));
    $out []= round(filesize(m_root($media[0]))/1000, 2) . ' KB';
  } else {
    $out []= strlen($child["body"]) . ' characters';
  }

  return $out;
}

function renderMedia($media) {
    /*
  if (count($media) > 1) {
    echo '<a href="'. m_url($media[1]) . '" target="_blank"><img class="fullscreen" src="' . m_url($media[0]) . '"></a>';
  } else {
    echo '<img class="fullscreen" src="' . m_url($media[0]) . '">';
  }
    */
?><canvas id="badge" datasrc="static/pde/TheServingLibrary.pde" width="200" height="200" tabindex="0" style="image-rendering: optimizeQuality !important;"></canvas><?
}

function processNews($child) {
  global $oo;

  $news_children = $oo->children($child['id']);
  $news_body = "<div id='news-content'></div>";

  $news_body .="<script>";
  $news_body .= "var newsItems = [";
  foreach($news_children as $news_child) {
    if (substr($news_child['name1'], 0, 1) == ".")
      continue;

    // get full url
    $ancestors = $oo->ancestors($news_child['id']);
    $full_url = "";
    foreach($ancestors as $ancestor)
      $full_url .= "/" . $oo->get($ancestor)['url'];
    $full_url .= "/" . $news_child['url'];

    $news_body .= '{"content": "'. $news_child['deck'] . '", "url": "' . $full_url . '"},';
  }

  $news_body .= "];";
  $news_body .="</script>";

  return array(
    "name1" => substr($child['name1'], 1),
    "body" => $news_body,
    "url" => "news",
  );
}
?>
<a href="#top" onclick="location.reload()"><div id="lozenge"><?= $title ?></div></a>
<div class="lang-toggle"><a href="/" class="<?= $uri[1] == "es" ? "" : "active" ?>">en</a> / <a href="/es" class="<?= $uri[1] == "es" ? "active" : "" ?>">es</a></div>
<a name='top'></a>
<div class="container">
  <div class = "column-container left"><?
for (; $idx < $length/2; $idx++) {
    $child = $children[$idx];
    $media = $oo->media($child["id"]);
    $child['body'] == "" ? $hasMedia = true : $hasMedia = false;
  ?>
  <div class= "child column-container-container <?= $child['url']; ?>" style="padding-left: <? echo getRandOffset($idx); ?>%; padding-right:<? echo getRandWidth($idx); ?>%;">
    <a class="anchor" name="<?= $child['url']; ?>"></a>
    <? if ($hasMedia) { renderMedia($media); } else  { echo '<div class="name">' . $child['name1'] . '</div>' . $child["body"]; } ?>
    <? $meta = getMeta($child, $media); ?>
    <div class="meta"><div class="modified"><? echo $meta[0]  ?></div><div class="filename"><? echo $meta[1]  ?></div><div class="size"><? echo $meta[2]  ?></div></div>
  </div>
<?
}
?></div><div class="column-container right"><?
for (; $idx < $length; $idx++) {
    $child = $children[$idx];
    $media = $oo->media($child["id"]);
    $child['body'] == "" ? $hasMedia = true : $hasMedia = false;
  ?>
  <div class= "child column-container-container <?= $child['url']; ?>" style="padding-left: <? echo getRandOffset($idx); ?>%; padding-right:<? echo getRandWidth($idx); ?>%;">
    <a class="anchor" name="<?= $child['url']; ?>"></a>
    <? if ($hasMedia) { renderMedia($media); } else  { echo '<div class="name">'. $child['name1'] . '</div>' . $child["body"]; } ?>
    <? $meta = getMeta($child, $media); ?>
    <div class="meta"><div class="modified"><? echo $meta[0]  ?></div><div class="filename"><? echo $meta[1]  ?></div><div class="size"><? echo $meta[2]  ?></div></div>
  </div>
<?
}
?></div>
</div>

<script>
var newsContent = document.getElementById('news-content');
var newsIdx = 0;

renderNews(newsIdx++);

setInterval(function() {
  return (function(idx) {
    renderNews(idx % newsItems.length);
  })(newsIdx++);
}, 10000);

function renderNews(idx) {
  while(newsContent.firstChild)
    newsContent.removeChild(newsContent.firstChild);

  var aTag = document.createElement('a');
  // aTag.setAttribute('href', newsItems[idx].url);
  aTag.setAttribute('href', '#');
  newsContent.appendChild(aTag);
  var i = 0;
  var txt = newsItems[idx].content;
  var speed = 40;

  function typeWriter() {
    if (i < txt.length) {
      aTag.innerHTML += txt.charAt(i);
      i++;
      setTimeout(typeWriter, speed);
    }
  }

  typeWriter();

  var d = new Date();
  document.querySelector('.child.news .meta .modified').innerHTML =
    "Modified " + d.getFullYear() +
    '-' + ("" + (d.getMonth() + 1)).padStart(2, 0) +
    '-' + ("" + d.getDate()).padStart(2, 0) +
    ' ' + ("" + d.getHours()).padStart(2, 0) +
    ':' + ("" + d.getMinutes()).padStart(2, 0) +
    ':' + ("" + d.getSeconds()).padStart(2, 0);

  document.querySelector('.child.news .meta .filename').innerHTML = txt.length + ' Characters';
}

</script>
