UZDUOTIS:

A) Sukurti web langa, kuriame butu 4 mygtukai/inputai:

1.Device id - cia leisti isivesti bet koki numeri is skaiciu ir raidziu
2.Koordinates – leisti ivesti bet kokias gps kordinates, pvz.: 9.0200417°, -79.5189333°
3.Pasirinkimas/selectas vienam is dvieju: "Home" ir "Work"
4.Mygtukas "Send".

Paspaudus mygtuka "Send" - programa turetu issiusti savo buvimo vieta, t.y gps kordinates, pasirinkima home arba work, bei device id i duombaze. 

B) Backend dalis, admino panele.
1. Prisijungimo langas. Sukurti 3 bet kokius userius su bet kokiu vardu ir slaptazodziu.
2. Kai bet kuris useris prisijungia, jis turi matyti langa kuris susideda is dvieju daliu. Desineje zemelapis(tarkim google maps), kaireje tuscias langas(~20% ekrano uzimantis) kuriame butu mygtukas „Add device“. Ji paspaudus turi leisti ivesti device id.
3. Kai web lange A, paspaudziama „Send“ – backend dalyje B ant zemelapio turi atsirasti pointeris/pozicija ant zemelapio.
4. Paspaudus ant ikono zemelapyje, turi atsiversti kazkoks popupas kuriame matytusi device id, home arba work ir adresas(ne kordinates). Kordinaciu pavertimui i adresa galima naudoti bet koki osm geocoderi(pavyzdys cia: http://wiki.openstre.../wiki/Nominatim), pakanka paduoti per url kordinates ir tau grazins adresa.
5. Jeigu web dalyje A issiuncia parametra "Work", t.y pazymejes buna work, issiusti emaila su device id ir adresu.
6.Backende, kaireje apacioje po visais device, parasyti kokie device turi didziausia atstuma tarp saves ir koks jis.