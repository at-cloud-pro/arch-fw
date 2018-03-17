<?php

//if (($_POST['game']!="cs")or($_POST['game']!="lol"))
//{
//header('Location: http://kktournament.pl/kkt');
//}

    $teamData = array(
        'game'=>$_POST['game'],
        'teamName' => $_POST['teamName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'voivodeship' => $_POST['voivodeship'],
        'city' => $_POST['city'],
        'teamCapitan' => $_POST['teamCapitan'],
        'player2' => $_POST['player2'],
        'player3' => $_POST['player3'],
        'player4' => $_POST['player4'],
        'player5' => $_POST['player5'],
        'reserve1' => $_POST['reserve1'],
        'reserve2' => $_POST['reserve2']);

    $CONTROLLER = new controller_teams();
    $CONTROLLER->addTeam($teamData);

 ?>
 <nav class="section-navigation-small outer-shadow">
     <a href="<?php echo $_PREFIX; ?>/" class="section-navigation-heading">
         <img src="img/cms/koziolek.png" alt="logo">
         <h1>KK-Tournament</h1>
     </a>
 </nav>
<main class="section-confirmation container-small outer-shadow">
    <h2>Potwierdzenie</h2>
    <p>Drużyna została zapisana! Poniżej znajdują się szczegóły zarejestrowanej drużyny:</p>
    <div class="section-confirmation-details">
        <table>
            <tr>
            	<td>Gra:</td><td><span class="really-important-info"><?php echo $teamData['game']; ?></span></td>
            </tr>
            <tr>
            	<td>Nazwa drużyny:</td><td><span class="really-important-info"><?php echo $teamData['teamName']; ?></span></td>
            </tr>
            <tr>
            	<td>E-mail kontaktowy:</td><td><span class="really-important-info"><?php echo $teamData['email']; ?></span></td>
            </tr>
            <tr>
            	<td>Numer kontaktowy:</td><td><span class="really-important-info"><?php echo $teamData['phone']; ?></span></td>
            </tr>
            <tr>
            	<td>Województwo:</td><td><span class="really-important-info"><?php echo $teamData['voivodeship']; ?></span></td>
            </tr>
            <tr>
            	<td>Miejscowość kapitana:</td><td><span class="really-important-info"><?php echo $teamData['city']; ?></span></td>
            </tr>
            <tr>
            	<td>Kapitan drużyny:</td><td><span class="really-important-info"><?php echo $teamData['teamCapitan']; ?></span></td>
            </tr>
            <tr>
            	<td>gracz nr. 2:</td><td><span class="really-important-info"><?php echo $teamData['player2']; ?></span></td>
            </tr>
            <tr>
            	<td>gracz nr. 3:</td><td><span class="really-important-info"><?php echo $teamData['player3']; ?></span></td>
            </tr>
            <tr>
            	<td>gracz nr. 4:</td><td><span class="really-important-info"><?php echo $teamData['player4']; ?></span></td>
            </tr>
            <tr>
            	<td>gracz nr. 5:</td><td><span class="really-important-info"><?php echo $teamData['player5']; ?></span></td>
            </tr>


            <tr>
            	<td>rezerwa nr. 1 (opcjonalnie):</td><td><span class="really-important-info"><?php echo $teamData['reserve1']; ?></span></td>
            </tr>
            <tr>
            	<td>rezerwa nr. 2 (opcjonalnie):</td><td><span class="really-important-info"><?php echo $teamData['reserve2']; ?></span></td>
            </tr>
        </table>
        <p>
            Zgodziliście się na przetwarzanie Waszych danych osobowych na cele turnieju, zapewniacie że jesteście w stanie przyjechać do Kędzierzyna w dniu finałów oraz że zapoznaliście i zgadzacie się z regulaminem turnieju.
        </p>

    </div>
    <a href="/kkt/" class="link-as-button">Powrót do strony głównej</a>
</main>
