<h5>Recherche par :</h5>

<section class="list">
<?php

echo "<div><article>";
echo "<header class='short-text'>";
echo anchor("recherche/view/artiste","Artiste");
echo "</header></article></div>";

echo "<div><article>";
echo "<header class='short-text'>";
echo anchor("recherche/view/album","Album");
echo "</header></article></div>";

echo "<div><article>";
echo "<header class='short-text'>";
echo anchor("recherche/view/chanson","Chanson");
echo "</header></article></div>";
?>
</section>