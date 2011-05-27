<?php

$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'cmCampers',
    'description' => 'Used for listing campers managed using CamperManagement.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/cmcampers.inc.php'),
));
//$properties = include $sources['data'].'properties/properties.cmcampers.php';
//$snippets[1]->setProperties($properties);

$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'cmCamperDetails',
    'description' => 'Used for showing an individual camper listing.',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/cmcamperdetails.inc.php'),
));
//$properties = include $sources['data'].'properties/properties.cmcampers.php';
//$snippets[1]->setProperties($properties);

return $snippets;

?>