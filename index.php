<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Wiki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/global.css">
  <link rel="stylesheet" href="./styles/cards.css">
</head>

<body>
  <?php
  include_once "./classes/DB.php";
  include_once "./classes/Nav.php";
  include_once "./classes/MakeCard.php";
  $db = new DB();
  $nav = new Nav();
  echo $nav->getNav();
  $pages = $db->fetchPageByTitle("_", true);
  ?>
  <div class="row mb-5">
    <!-- Presentazione -->
    <div class="col-11 mx-auto p-4 mt-3 info bg-spruce">
      Questa Wiki è la tua guida completa al mondo di Minecraft, il celebre gioco sandbox di Mojang Studios. Che tu sia
      un nuovo giocatore curioso di capire come sopravvivere alla prima notte, o un veterano esperto alla ricerca di
      dettagli tecnici e strategie avanzate, qui troverai tutto ciò che ti serve.
      <br>
      📦 Esplora i blocchi e gli oggetti: Scopri le caratteristiche, gli usi e le ricette di crafting di ogni elemento.
      <br>
      🧱 Guida alla sopravvivenza e alla creatività: Dalle basi della raccolta risorse fino alla costruzione di
      meccanismi complessi con la redstone.
      <br>
      👾 Mob e Boss: Informazioni dettagliate su creature passive, ostili e neutrali, compresi i boss come il Wither e
      il Drago dell'End.
      <br>
      🌍 Biomi e dimensioni: Approfondimenti su tutti i biomi, dal tranquillo prato fiorito al temibile Nether, fino
      all'End.
      <br>
      ⚙️ Aggiornamenti e novità: Rimani aggiornato sulle ultime versioni, snapshot e patch ufficiali.
      <br>
      Questa Wiki è costruita dalla community, per la community. Se hai conoscenze da condividere, contribuisci anche tu
      a renderla sempre più completa e utile!
      <br>
      Per iniziare a condividere la tua conoscenza registrati e clicca su crea
    </div>
    <div class="mx-auto col-10">
      <h1 class="fs-2 mt-3">
        Le nostre pagine
      </h1>
      <hr class="separator">
    </div>
    <div class="col-11 mx-auto row row-cols-sm-1 row-cols-md-3 row-cols-lg-5">
      <?php
      foreach ($pages as $page) {
        ?>
        <div class="px-3 col">
          <?php
          makeCard($page);
          ?>
        </div>
        <?php
      }
      ?>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>