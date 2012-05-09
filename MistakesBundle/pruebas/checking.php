<?php
namespace Mistakes\MistakesBundle\pruebas;

$xmlprojects = loadprojects();
$xmlerrors = loaderrors(10);
resetErrors();
seterrors();

echo '<table border="1">
<tr>
<th>name</th>
<th>number</th>
<th>cont</th>

</tr>';
foreach($projects as $proj => $cont){
	echo '<tr>
	<td>' . $projectsname[(int)$proj] . '</td>
	<td>' . $proj . '</td>
	<td>' . $cont . '</td>

	</tr>';
}
}

