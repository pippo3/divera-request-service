# Divera Request Service

- **License**: WTFPL v2 – Do What the Fuck You Want to Public License

## Übersicht
Dies ist ein kleines Skript, welches den [Divera 24/7](https://www.divera247.com) Request Service verwendet. Das Skript wurde  für die [Freiwillige Feuerwehr Lohfelden](http://www.feuerwehr-lohfelden.de/home.html) erstellt. Das heißt ihr könnt es so nicht 1:1 verwenden. Sicher kann man aber mit kleineren Anpassungen dieses auch für eine ganze Reihe weiterer Organisationen verwenden.

## Hintergrund
Warum haben wir uns dazu entschieden den Request Service zu verwenden? Das liegt daran, dass unsere Leitstelle in Kassel Alarmmeldungen als reine Textsuppe versendet. Es ist nicht möglich diese als Felder aufzuteilen. Das heißt, dass wir im Standard nur den Text via Web-Api an Divera verschicken können. Weder der Titel oder die Adresse sind so möglich. Dem Entsprechend bietet Divera dann für uns kaum einen Mehrwert.

Im Folgenden ist kurz dargestellt, wie unser Aufbau ist und für was wir das Skript verwenden.

![Ablauf](http://www.feuerwehr-lohfelden.de/fileadmin/doku/ablauf.jpg)

## Technischer Ablauf
Das Skript erhält durch den Divera Request Service ein JSON Objekt (Auswahl Vollständiges Objekt). Dieses JSON enthält die Informationen, die Divera durch den Web API Aufruf von Tetra Control erhält.

Beispiel eines solchen Aufrufes (JSON Objekt)

    { 
       "id":1273779,
       "title":"Einsatz",
       "text":"S20*B190806348*BFBMA*CRUMBACH AM FIESELER WERK 9 LOHFELDEN 350",
       "address":"",
       "lat":0,
       "lng":0,
       "priority":0,
       "notification_type":4,
       "cluster":[ 
    
       ],
       "vehicle":[ 
    
       ],
       "group":[ 
    
       ],
       "user_cluster_relation":[ 
          85517
       ],
       "ts_create":1566638879,
       "ts_update":1566638879
    }

Wie man gut erkennen kann, wird eigentlich nur der Text übertragen. Der Titel ist (Einsatz) wird einfach durch Tetra Control immer Fix mitgegeben.

Die Sxntax des Textes ist wie folgt:

    S20*B190806348*BFBMA*CRUMBACH AM FIESELER WERK 9 LOHFELDEN 350
    [Gruppe]*[Alarmnummer]*[Alarmstichwort]*[Ortsteil][Adresse][NrRauchmelder]
    
Das Skript nimmt führt jetzt die folgenden Schritte durch

1.) Schritt 1:
    Aufsplitten der einzelnen Teile des Textens anhand des Zeiches  `*`. Danach sollten es immer 4 Teile sein.

2.) Schritt 2:
    Das dritte Element (hier „BFMA“) wird anhand der definierten [Einsatzstichwörter des Landes Hessen](https://innen.hessen.de/sites/default/files/media/hmdis/einsatzstichworteerl-16.pdf) in Text übersetzt. Aus `BFMA` wird dann `BFBMA - Brandmeldeanlage`
    
3.) Schritt 3:
    Der Alarmtext wird anhand des in der Konfiguration definierten Langtextes und der Ursprünglichen Meldung generiert. Dieser Basiert dann auch wieder auf dem Alarmstichwort. 

4.) Schritt 4:
    Die Adresse wird anhand des vierten Elementes ermittelt. Hier ist die Aufteilung ja immer Ortsteil, Adresse und Rauchmelder-Nummer. Dazu wird zunächst der Ortsteil entfernt und die Rauchmelder-Nummer, sofern diese enthalten ist. Anhand der Adresse versucht Divera die Lokalisierung bei Google Maps zu machen.

5.) Schritt 5:
    Anhand der Einsatzstichworte haben wir für uns intern eine Alarm- und Ausrückeordnung definiert. Diese sieht bestimmte Fahrzeuge für die Schadensereignisse vor. Diese haben wir ebenfalls in der Konfiguration anhand des Alarmstichwortes definiert. Daraus ergibt sich dann eine Empfehlung für den Einsatzleiter. Die Fahrzeuge müssen natürlich in Divera angelegt sein. Über den Kenner (RIC) findet dann die Zuordnung statt. Beispielsweise ist in unserem Fall `LOHDLK = Drehleiter 18/12(DL(A) K 18/12)`

Anschließend wird die Web-API erneut aufgerufen und die einzelnen Komponenten als JSON via CURL übergeben. Für unser Beispiel sieht das dan wie folgt aus:

    { 
       "priority":1,
       "type":"BFBMA - Brandmeldeanlage",
       "text":"Ausl\u00f6sung einer Brandmeldeanlage S20*B190806348*BFBMA*CRUMBACH AM FIESELER WERK 9 LOHFELDEN 350",
       "address":"AM FIESELER WERK 9 LOHFELDEN",
       "vehicle":"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
    }
    
Da die Alarmmeldungen in Divera zusammengefasst werden, wird der Alarm nicht nochmal ausgelöst.

## Testen
Um euch beim anpassen zu unterstützen, habe ich ein Logging eingeführt, welches den initialen Aufruf von Divera loggt, aber auch den Request zu Divera. Sollte es bei der Bearbeitung zu einem Fehler kommen, wird dieser auch ausgegeben. Dazu verwende ich die Bibliothek [log4php](https://logging.apache.org/log4php/) die noch im `/lib` Verzeichnis installiert werden muss. Diese schreibt die Ausgaben in ein Log File unter `/log`
Des Weiteren kann man auch den kompletten Request zu Divera loggen, indem man in der Konfiguration einfach als diveraUrl das Testskript `logDiveraRequest.php` verwendet.
