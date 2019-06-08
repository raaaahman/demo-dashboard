<?php
	$page_title = "Statistiques sur les utilisateurs";
	$has_drawer_menu = true;
	ob_start();
?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!--googlemaps key AIzaSyAWVl94fRBI4gTrVwQa0d-SD4_TWZB8Mao-->
	<script type="text/javascript">

      /*Création d'un tableau qui stocke les pays pour des utilisateurs, ces pays ont été récupérés par la requête SQL*/
      var myUsersCountries = [["Pays", "Utilisateurs"]];

      //On rempli le tableau par php, en sécurisant les données récupérées
      <?php
        foreach($users_stats["countries"] as $row) {
          echo 'myUsersCountries.push([' . json_encode($row["pays"]) . ', ' . $row["nb_users"] . ']);';
        }
      ?>

      /*On fait de même pour les âges et sexes des utilisateurs*/
      var myUsersAges = [["Tranche d\'âge", "Hommes", "Femmes"]];
      //Insertion des entrées du tableau
      <?php
        foreach($users_stats["ages"] as $row) {
          echo "myUsersAges.push([" . json_encode($row["tranche_age"]) .", " . $row["nb_hommes"] . ", " . $row["nb_femmes"] . "]);";
        }
      ?>

      /*Et également pour le diagramme des genres*/
      var myUsersGenres = [["Genre", "Nombre d\'utilisateurs"]];

      //Insertion des données dans le tableau
      <?php
        foreach($users_stats["genres"] as $row) {
          echo 'myUsersGenres.push([' . json_encode($row["genre"]) . ', ' . $row["nb"] . ']);';
        };
      ?>

      //Création de la carte google charts
      //Récupération des libriairies
      google.charts.load('current', {'packages':['bar', 'corechart']});
      //Appel de la charte des ages et sexes
      google.charts.setOnLoadCallback(drawUsersAges);
      //Appel de la charte géographique
      google.charts.setOnLoadCallback(drawUsersMap);
      //Appel du diagramme en camembert
      google.charts.setOnLoadCallback(drawUsersGenre);

      //Notre tableau récupéré des variables PHP
      function drawUsersMap() {

        var data = google.visualization.arrayToDataTable(myUsersCountries);

        var options = {
            title : "Carte des utilisateurs",
          colorAxis: {colors: ["#8ca9d8", "#454077"]}};

        var chart = new google.visualization.GeoChart(document.getElementById('worldmap'));

        chart.draw(data, options);
      }

      function drawUsersAges() {
        var data = google.visualization.arrayToDataTable(myUsersAges);

        var options = {
          chart: {
            title: 'Utilisateurs par tranche d\'âge'
          }
        }

        var chart = new google.charts.Bar(document.getElementById('ages'));

        chart.draw(data, options);
      }

      function drawUsersGenre() {
        var data = google.visualization.arrayToDataTable(myUsersGenres);

        var options = {
          title: 'Répartition des utilisateurs par genre',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('genres'));
        chart.draw(data, options);
      }

    </script>

<?php
	$head_comp = ob_get_contents();
	ob_end_clean();


	ob_start();
?>
  <div class="mdl-cell mdl-cell--12-col">
    <figure id="worldmap"></figure>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <figure id="genres"></figure>
  </div>
  <div class="mdl-cell mdl-cell--6-col">
    <figure id="ages"></figure>
  </div>
<?php
	$main_content = ob_get_contents();
	ob_end_clean();

	require "template.view.php";
?>
