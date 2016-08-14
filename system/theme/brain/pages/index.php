<html>
   <head>
      <meta name="robots" content="index,follow,all"/>
      <meta name="description" content="Maak vrienden, doe mee en val op!"/>
      <meta name="keywords" content="<?= $config['hotelName'] ?>, <?= $config['hotelName'] ?>hotel, <?= $config['hotelName'] ?> hotel, virtueel, wereld, sociaal netwerk, gratis, community, avatar, chat, online, tiener, roleplaying, doe mee, sociaal, groepen, forums, veilig, speel, games, online, vrienden, tieners, zeldzaams, zeldzame meubi, verzamelen, maak, verzamel, kom in contact, meubi, meubeks, huisdieren, kamer inrichten, delen, uitdrukking, badges, hangout, muziek, beroemdheid, VIP-visits, celebs, mmo, mmorpgs, massive multiplayer"/>
      <meta name="build" content="AuroraCMS - RELEASE-02082016"/>
      <title><?= $config['hotelName'] ?> Hotel: Beleef het plezier!</title>
      <meta name="ripperonline" content="<?= Game::usersOnline() ?>">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
      <!DOCTYPE>
      <html lang="en">
         <link rel="stylesheet" href="/system/theme/brain/style/css/index/animate1.css" type="text/css">
         <script src="/system/theme/brain/style/js/index/jquery.min.js"></script>
         <script src="/system/theme/brain/style/js/index/index.js"></script>
         <script type="text/javascript">function siteUrl() {return "";}function showReg() {window.location = siteUrl() + "register";}</script>
         </head>
         <body>
            <div id="site">
               <div id="body">
                  <link rel="stylesheet" href="/system/theme/brain/style/css/index/style.css">
                  <link rel="stylesheet" href="/system/theme/brain/style/css/index/StyleIndex.css">
                  <style type="text/css">
                     @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,700,300);
                     @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,700);
                  </style>
                  <header style="background-position-x: -4607px;">
                     <div id="main">
                        <div class="left">
                           <div id="banner-counter-container-box">
                              <img src="/system/theme/brain/style/images/logo/logo.png" style="margin-top: -20px"><br>
                              <div class="text">
                                 <div class="animated bounceIn"><b><?= Game::usersOnline() ?></b> <?= $config['hotelName'] ?>'s Online!</div>
                              </div>
                           </div>
                        </div>
                        <div class="animated bounceIn">
                           <div class="login">
                              <form method="post">
                              <form action="post" method="post">
                                 <b><font color="red"><?php User::Login(); ?></font></b>			
                                 <div class="pfeil"> 	</div>
                                 <input type="hidden" name="hiddenField_login" required="" value="<?= hiddenField(); ?>"></input>
                                 <input type="text" id="username" name="username" placeholder="Gebruikersnaam">
                                 <input type="password" id="password" name="password" placeholder="Wachtwoord">
                                 <button type="submit" class="submit" name="login"><img src="/system/theme/brain/style/images/login/go.gif">
                           </div>
                           </button></form>
                        </div>
                     </div>
                  </header>
                  <div id="main" class="pcon">
                     <div id="info-container-box">
                        <div class="ajax">
                        </div>
                        <div class="text">
                           <div class="animated bounceIn">
                              <center>
                                 <h2><b>Hey, welkom op <?= $config['hotelName'] ?>!</b></h2>
                                 <p><b>Welkom op <?= $config['hotelName'] ?>, Vergeet niet je vrienden uit te nodigen!</b></p>
                              </center>
                           </div>
                        </div>
                        <div onclick="showReg();" id="registerbutton">
                           <div class="animated bounceIn">Registreer
                           </div>
                        </div>
                     </div>
                     <div id="recorder-container-box" style="background-image: url(/system/theme/brain/style/images/login/spielbox-bg.png)">
                        <div class="text">
                           <div class="animated bounceIn">
                              <b>
                                 <center>Snelheid & Lag</center>
                              </b>
                              Dit betekend dat we een stabiele en consistente omgeving kunnen garanderen, voor u allen om te spelen! Merk  je dat je in de problemen komt? neem dan zo snel mogelijk contact op met een medewerker! We kunnen je niet helpen als je niet vraagt.<br><br><br><br><br><br>
                           </div>
                        </div>
                     </div>
                     <div id="recorder-container-box" style="background-image: url(/system/theme/brain/style/images/login/eventbox-bg.png); margin-left: 19px;">
                        <div class="text">
                           <div class="animated bounceIn">
                              <b>
                                 <center>Dagelijkse Evenementen</center>
                              </b>
                              Hier bij <?= $config['hotelName'] ?> Hotel, onze medewerker(s) zijn gemotiveerd en zal dagelijks evenementen organiseren, Dit zorgt ervoor dat jij en de rest van de leden niet je eigen vervelen. Als er geen evenementen worden georganiseerd, moet u bedrade evenementen zoals Ping Pong spelen, Beat the Holo, en de draak mig's doolhof!<br><br><br><br>
                           </div>
                        </div>
                     </div>
                     <div id="recorder-container-box" style="background-image: url(/system/theme/brain/style/images/login/updatebox-bg.png); float: right; margin-right: 0px;">
                        <div class="text">
                           <div class="animated bounceIn">
                              <b>
                                 <center>Updates</center>
                              </b>
                              We werken onze server dagelijks bij, het toevoegen van nieuwe functies voor de client en de website. Deze functies kunnen omvatten dingen zoals nieuwe commando's, nieuw meubilair, nieuwe website features, en ga zo maar door! Als er een meubels, badge of opdracht die we niet hebben, en je wilt .. Gewoon vragen! Een van de ontwikkelaars zal het toevoegen!<br><br><br>
                           </div>
                        </div>
                     </div>
                  </div>
                  <br>
                  <div id="footer" style="font-family: verdana, arial, sans-serif;">
                     <div id="inner">
                        <div id="middle">Copyright <b>© 2016 <?= $config['hotelUrl'] ?></b> - Alle rechten voorbehouden.
                           <br>We zijn niet onderschreven, verbonden of worden aangeboden door Sulake Corporation Oy.
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </body>
      </html>