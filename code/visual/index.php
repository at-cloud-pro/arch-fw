<div id="toTop" class="container">
    <nav class="section-navigation outer-shadow">
        <a href="<?php echo $_PREFIX; ?>/#toTop" class="section-navigation-heading">
            <img src="img/cms/koziolek.png" alt="logo">
            <h1>KK-Tournament</h1>
        </a>
        <ul>
            <li><a href="#about">O nas</a></li>
            <li><a href="#lol">LoL</a></li>
            <li><a href="#cs">CS:GO</a></li>
            <li><a href="#register">Rejestracja</a></li>
            <li><a href="#contact">Kontakt</a></li>
        </ul>
    </nav>
    <section class="section-parallax" id="section-parallax">
        <header class="section-parallax-header container-small outer-shadow">
             <img src="img/cms/koziolek.png" alt="logo">
        </header>
    </section>
    <section class="section-about" id="about">
        <div class="section-about-container">
            <div class="section-about-element">
                <div class="section-about-element-image"><img src="https://via.placeholder.com/130x130" alt="" /></div>
                <div class="section-about-element-text">
                    <h2>Galeria</h2>
                    <p>Nie samymi ładnymi słowami turniej stoi - nie zapomnij zajrzeć do naszej skromnej galerii, gdzie znajdziesz zdjęcia z poprzedniej edycji turnieju, być może odnajdziesz siebie lub swoich znajomych. Większość zdjęć zawdzięczamy patronom medialnym.</p>
                </div>
                <a href="https://drive.google.com/drive/folders/1qB8sWHkfPFIwRh1bukfkJsL01GFX9n_v" class="link-as-button">Zobacz zdjęcia</a>
            </div>
            <div class="section-about-element">
                <div class="section-about-element-image"><img src="img/cms/section-onas.png" alt="" /></div>
                <div class="section-about-element-text">
                    <h2>O nas</h2>
                    <p>Jesteśmy grupą kreatywnych osób z pierwszej w Polsce szkoły e-sportowej w Kędzierzynie Koźlu. Mamy różne zinteresowania od tworzenia stron, grafikę po grzebanie w podzespołach, ale to właśnie o to chodzi - mamy wspólną pasję.</p>
                </div>
                <a href="./articles/o-nas" class="link-as-button">Czytaj więcej...</a>
            </div>
            <div class="section-about-element">
                <div class="section-about-element-image"><img src="https://via.placeholder.com/130x130" alt="" /></div>
                <div class="section-about-element-text">
                    <h2>Historia</h2>
                    <p>Kędzierzyn-Koźle jest naszym miastem i słynie głównie z przemysłu. 3 lata temu została tu utworzona pierwsza klasa w Europie o profilu technik informatyk z możliwością kształcenia w e-sporcie i tworzeniu gier pod okiem specjalistów. </p>
                </div>
                <a href="<?php echo $_PREFIX; ?>/articles/historia" class="link-as-button">Czytaj więcej...</a>
            </div>
        </div>
    </section>
    <section class="section-left" id="lol">
        <div class="section-left-container">
            <div class="section-left-image"><img src="img/cms/section-lol.jpg" alt="" /></div>
            <div class="section-left-article">
                <h2>League of Legends</h2>
                <p>Ciesząca się olbrzymią popularnością gra typu MOBA (Multiplayer Online Battle Arena), wyprodukowana przez studio Riot Games. Akcja League of Legends osadzona została w fantastycznym świecie Valoran, którym przez wieki targały krwawe wojny. Rozgrywka zaprojektowana została z myślą o zabawie multiplayer w trybie rywalizacji dwóch kilkuosobowych drużyn. Każdy z graczy kontroluje poczynania jednego bohatera. Kluczem do zwycięstwa są zazwyczaj współpraca w grupie oraz umiejętność wykorzystania indywidualnych atutów każdej z postaci.</p>
                <div class="section-left-article-buttons">
                    <a href="#" class="link-as-button inverted">Drabinki</a>
                    <a href="./docs/regulamin-lol.pdf" class="link-as-button" target="_blank">Regulamin</a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-right" id="cs">
        <div class="section-right-container">

            <div class="section-right-article">
                <h2>Counter Strike: Global Offensive</h2>
                <p>Nowa odsłona legendarnej sieciowej strzelaniny, która zadebiutowała blisko dekadę wcześniej jako modyfikacja pierwszej części FPS-a Half-Life. Rozgrywka skupia się na rywalizacji dwóch drużyn graczy, złożonych z terrorystów oraz próbujących ich powstrzymać jednostek specjalnych. Dzięki eliminacji przeciwników gracze zyskują gotówkę, którą mogą spożytkować na zakup nowego uzbrojenia.</p>
                <div class="section-right-article-buttons">
                    <a href="#" class="link-as-button inverted">Drabinki</a>
                    <a href="./docs/regulamin-cs.pdf" class="link-as-button" target="_blank">Regulamin</a>
                </div>
            </div>
            <div class="section-right-image"><img src="img/cms/section-cs.jpg" alt=""/></div>
        </div>
    </section>
    <section class="section-register-closed" id="register">
         <div class="section-register-container">
        <?php /*
            <h2>Rejestracja do turnieju</h2>
            <p>Aby się zarejestrować do turnieju wystarczy uzupełnić poniższy formularz. Pamiętajcie o poprawności danych (szczególnie e-mail i nr. telefonu!) ponieważ błąd w nich będzie powodować brak kontaktu z Wami, a zarazem dyskwalifikację z turnieju. Pamiętajcie aby zaznajomić się także z <a class="visible-link" href="http://www.kktournament.pl/regulamin">regulaminem</a>!</p>
            <p>Zgłoszenie drużyny w Turnieju KK-Tournament jest płatne, koszt turnieju to 50 PLN od jednej drużyny. Dane do przelewu podane są przy potwierdzeniu rejestracji. Drużyny które do 7 kwietnia nie opłacą opłaty wstępnej zostaną zdyskwalifikowane. Dochód z wpłat jest przeznaczony na cele charytatywne.</p>
            <form class="section-register-form" action="registration-complete" method="post">
                <h3>Nazwa i kontakt z drużyną</h3>
                <section class="section-register-form-section">
                    <div class="section-register-form-item">
                        <label for="game">Wybierz grę...</label>
                        <select name="game" id="game">
                            <option value="cs">CS:GO</option>
                            <option value="lol">League of Legends</option>
                        </select>
                    </div>
                    <div class="section-register-form-item">
                        <label for="teamName">Nazwa drużyny</label>
                        <input type="text" name="teamName" id="teamName" maxlength="20" placeholder="5 do 20 znaków" required pattern=".{5,20}">
                    </div>
                    <div class="section-register-form-item">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" value="" placeholder="" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="phone">Numer telefonu (kontaktowy)</label>
                        <input type="tel" name="phone" id="phone" pattern="[0-9]{7,11}" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="voivodeship">Województwo</label>
                        <select name="voivodeship" id="voivodeship" required>
                            <option value="" disabled>Wybierz województwo</option>
                            <option value="D">dolnośląskie</option>
                            <option value="C">kujawsko-pomorskie</option>
                            <option value="L">lubelskie</option>
                            <option value="F">lubuskie</option>
                            <option value="E">łódzkie</option>
                            <option value="K">małopolskie</option>
                            <option value="W">mazowieckie</option>
                            <option value="O" selected>opolskie</option>
                            <option value="R">podkarpackie</option>
                            <option value="B">podlaskie</option>
                            <option value="G">pomorskie</option>
                            <option value="S">śląskie</option>
                            <option value="T">świętokrzyskie</option>
                            <option value="N">warmińsko-mazurskie</option>
                            <option value="P">wielkopolskie</option>
                            <option value="Z">zachodniopomorskie</option>
                        </select>
                    </div>
                    <div class="section-register-form-item">
                        <label for="city">Miejscowość kapitana drużyny</label>
                        <input type="text" name="city" id="city" required>
                    </div>
                </section>
                <h3>Członkowie drużyny</h3>
                <section class="section-register-form-section">
                    <div class="section-register-form-item-middle">
                        <label for="teamCapitan">Kapitan drużyny</label>
                        <input type="text" name="teamCapitan" id="teamCapitan" value="" placeholder="Imię i nazwisko" required>
                    </div>
                    <div class="section-register-form-item section-register-form-item">
                        <label for="player2">gracz nr. 2</label>
                        <input type="text" name="player2" id="player2" value="" placeholder="Imię i nazwisko" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="player3">gracz nr. 3</label>
                        <input type="text" name="player3" id="player3" value="" placeholder="Imię i nazwisko" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="player4">gracz nr. 4</label>
                        <input type="text" name="player4" id="player4" value="" placeholder="Imię i nazwisko" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="player5">gracz nr. 5</label>
                        <input type="text" name="player5" id="player5" value="" placeholder="Imię i nazwisko" required>
                    </div>
                    <div class="section-register-form-item">
                        <label for="reserve1">rezerwa nr. 1 (opcjonalnie)</label>
                        <input type="text" name="reserve1" id="reserve1" value="" placeholder="Imię i nazwisko">
                    </div>
                    <div class="section-register-form-item">
                        <label for="reserve2">rezerwa nr. 2  (opcjonalnie)</label>
                        <input type="text" name="reserve2" id="reserve2" value="" placeholder="Imię i nazwisko">
                    </div>
                </section>
                <h3>Ostatnie szczegóły...</h3>
                <section class="section-register-form-section-check">
                    <div class="section-register-form-check">
                        <input type="checkbox" id="legal-1" name="legal-1" value="" required>
                        <label for="legal-1">Wyrażam zgodę na przetwarzanie danych osobowych
                             moich jak i członków mojej drużyny zawartych w tym formularzu
                             na potrzeby organizacji turnieju (zgodnie z Ustawą z dnia
                              29.08.1997 roku o Ochronie Danych Osobowych; tekst jednolity:
                               Dz. U. z 2002r. Nr 101, poz. 926 ze zm.)
                         </label>
                    </div>
                    <div class="section-register-form-check">
                        <input type="checkbox" id="legal-2" name="legal-2" value="" required>
                        <label for="legal-2">Oświadczam że w dniu finału (2-3
                        czerwca 2018 roku) jestem w stanie wraz z moją drużyną
                            pojawić się na LANie KK-Tournament w Kędzierzynie-Koźlu.
                         </label>
                    </div>
                    <div class="section-register-form-check">
                        <input type="checkbox" id="legal-3" name="legal-3" value="" required>
                        <label for="legal-3">Oznajmiam że ja i wszyscy członkowie mojej drużyny zapoznali
                            się z <a class="visible-link" href="http://www.kktournament.pl/regulamin" target="_blank">regulaminem</a>, oraz
                            zgadzają się na zasady tam przedstawione.
                         </label>
                    </div>
                    <input type="submit" value="Zapisz drużynę!">
                </section>
            </form>
        
         */ ?>
        <h2>Rejestracja już wkrótce!</h2>
        <p>Zapisy odbędą się drogą internetową, przez stronę www.kktournament.pl, rozpoczną się w poniedziałek 12 marca 2018 o godzinie 0:00, zakończą 31 marca o godzinie 23:59. Strona posiada certyfikat HTTPS, więc wszelkie wprowadzane tutaj informacje są bezpiecznie dostarczane na serwer. Wpisowe na turniej wynosi 25 złotych, termin płatności to 7 kwietnia, numer konta jest podany w potwierdzeniu które wyskakuje po zapisaniu drużyny w przygotowanym formularzu. Kwota 25 złotych jest niezależna od ilości graczy w drużynie (5-7) i jest przekazywana na cele charytatywne.</p>
        </div>
    </section>
    <section class="section-contact" id="contact">
        <div class="section-contact-container">
            <h2>Kontakt</h2>
            <p>Do Kędzierzyna można dojechać pociągami bezpośrednimi z Gliwic, Wrocławia, Opola, Raciborza, Nysy (PolRegio) a także większości miast wojewódzkich (PKP Intercity), także autobusami z miast województwa (Arriva / PKS), przez Kędzierzyn przejeżdżają także autobusy dalekobieżne.</p>
            <div id="map">
            </div>
            <div class="section-contact-description">
                <p>z dworca PKP - jeden przystanek autobusem linii: 1 (kier. Azoty), 2 (kier. Biurowiec Z.CH.), 5 (kier. Sławięcice), 12 (kier. Biurowiec Z.CH.), 13 (kier. Elektrownia Blachownia), 15 (kier. Sławięcice), lub kilkunastominutowy spacerek.</p>
                <p>z dworca PKS - dojazd do przystanku "Hala Sportowa", "1 Maja" lub "Pionierów" liniami: 1 (kier. Azoty), 2 (kier. Biurowiec Z.CH.), 12 (kier. Biurowiec Z.CH.), 13 (kier. Elektrownia Blachownia), 15 (kier. Sławięcice), lub godzinny spacerek.</p>
                <p>Autem - pod Halą znajduje się parking na około 50 aut, miejsc parkingowych można szukać także pod kinem Chemik, osiedlu NDM lub wzdłóż ul. Wojska Polskiego.</p>
                <p>Rozkłady pociągów - <a class="visible-link"  href="http://www.koleo.pl" target="_blank">KOLEO</a>, rozkłady autobusów miejskich - <a class="visible-link" href="http://www.mzkkk.pl" target="_blank">MZK w Kędzierzynie-Koźlu</a>.</p>
            </div>
        </div>
    </section>
    <section class="section-sponsors">
        <div class="section-sponsors-container">
            <h2>Sponsorzy</h2>
            <p>Chcesz zostać sponsorem? Tu może być Twoje logo! Pisz śmiało!</p>
            <a href="<?php echo $_PREFIX; ?>articles/sponsor" class="link-as-button">Zostań sponsorem!</a>
        </div>
    </section>
    <section class="section-documents" id="about">

        <div class="section-documents-container">
            <h2>Dokumenty</h2>
            <p>Jak każda organizacja udostępniamy publicznie dokumenty do pobrania. Dostępne są regulaminy i inne papiery, miłego czytania ;)</p>
            <div class="section-documents-downloads-container">
                <div class="section-documents-element">
                    <span class="fa fa-file-o"></span>
                    <div class="section-documents-element-text">
                        <p>Regulamin rozgrywek Counter Strike: GO</p>
                    </div>
                    <a href="./docs/regulamin-cs.pdf" class="link-as-button" target="_blank">Pobierz >></a>
                </div>
                <div class="section-documents-element">
                    <span class="fa fa-file-o"></span>
                    <div class="section-documents-element-text">
                        <p>Regulamin rozgrywek League of Legends</p>
                    </div>
                    <a href="./docs/regulamin-lol.pdf" class="link-as-button" target="_blank">Pobierz >></a>
                </div>
                <div class="section-documents-element">
                    <span class="fa fa-file-o"></span>
                    <div class="section-documents-element-text">
                        <p>Regulamin sekcji e-sportowej</p>
                    </div>
                    <a href="./docs/regulamin-ksc.pdf" class="link-as-button" target="_blank">Pobierz >></a>
                </div>
            </div>
        </div>
    </section>
    <footer class="section-footer">
        <a href="http://www.archi-tektur.pl">
            <div class="section-footer-author">
                <span class="fa fa-code fa-fw fa-2x" aria-hidden="true"></span><span class="section-footer-author-span">Oskar 'archi_tektur' Barcz</span><br />
                <span class="fa fa-picture-o fa-fw fa-2x" aria-hidden="true"></span><span class="section-footer-author-span">Kasia 'Kaśke' Pytlik</span>
            </div>
        </a>
        <div class="section-footer-social">
            <div class="section-footer-social-fb">
                <a href="https://www.facebook.com/kktournament/" target="_blank"><span class="fa fa-facebook" aria-hidden="true" title="Znajdź nas na FB!"></span></a>
            </div>
            <div class="section-footer-social-mess">
                <a href="https://www.facebook.com/messages/t/kktournament" target="_blank"><span class="fa fa-commenting" aria-hidden="true" title="Napisz do nas!"></span></a>
            </div>
            <div class="section-footer-social-ig">
                <a href="https://www.instagram.com/archi_tektur" target="_blank"><span class="fa fa-instagram" aria-hidden="true" title="Instagram programisty strony czci wszelakiej godnego"></span></a>
            </div>
            <div class="section-footer-social-up">
                <a href="#toTop"><span class="fa fa-chevron-circle-up" aria-hidden="true" title="Do góry!"></span></a>
            </div>
        </div>
    </footer>
</div>
