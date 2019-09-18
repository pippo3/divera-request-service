<?php
/**
 * Created by PhpStorm.
 * User: cpippert
 * Date: 07.11.2018
 * Time: 09:30
 */

return [
    "diveraUrl" => "https://www.divera247.com/api/alarm?accesskey=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
    //"diveraUrl" => "http://localhost/divera-request-service/test/logDiveraRequest.php",
    "alarmKeywords" => [
        "BF1"       => [
            "short" => "Kleinbrand",
            "long"  => "",
            "vehicle" =>"LOHELW1,LOHTLF"
        ],
        "BF2"       => [
            "short" => "Brand",
            "long"  => "",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BF2Y"      => [
            "short" => "Brand",
            "long"  => "Brand - Menschenleben in Gefahr",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BF3"       => [
            "short" => "Brand",
            "long"  => "Ausgedehnter Brand in Sondergebäuden",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BF3Y"      => [
            "short" => "Brand",
            "long"  => "Ausgedehnter Brand in Sondergebäuden - Menschenleben in Gefahr",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BF4"       => [
            "short" => "Brand",
            "long"  => "Brand als Großschadenslage",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BFBMA"     => [
            "short" => "Brandmeldeanlage",
            "long"  => "Auslösung einer Brandmeldeanlage",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BFBUSY"    => [
            "short" => "Brand",
            "long"  => "Brand eines besetzten Busses - Menschenleben in Gefahr",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "BFGAS1"    => [
            "short" => "Brand",
            "long"  => "Brand Gasflaschen / Gasleitung",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BFGAS2"     => [
            "short" => "Brand",
            "long"  => "Brand eines Gastanks / Gastankfahrzeugs / Gaskesselwagens",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "BFLKW"     => [
            "short" => "Brand",
            "long"  => "Brand LKW / Bus ohne Personen / landwirtschaftliche Arbeitsmaschine",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "BFRWM"     => [
            "short" => "Brand",
            "long"  => "Meldung eines ausgelösten Rauchwarnmelders",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK"
        ],
        "BFWALD1"   => [
            "short" => "Waldbrand",
            "long"  => "Brand eines Waldes oder einer Wiese mit geringer oder keiner Ausbreitungsgefahr",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL"
        ],
        "BFWALD2"       => [
            "short" => "Waldbrand",
            "long"  => "Brand eines Waldes oder einer Wiese mit der Gefahr der weiteren Ausdehnung",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "H1"        => [
            "short" => "Hilfeleistung",
            "long"  => "Kleineinsatz",
            "vehicle" =>"LOHELW1,LOHTLF"
        ],
        "H1Y"       => [
            "short" => "Hilfeleistung",
            "long"  => "Menschenleben in Gefahr",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK"
        ],
        "H2"        => [
            "short" => "Hilfeleistung",
            "long"  => "",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "HABSTY"    => [
            "short" => "Hilfeleistung",
            "long"  => "Person in Absturzgefahr oder droht zu springen",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "HELEK"     => [
            "short" => "Hilfeleistung",
            "long"  => "Unfall in großen elektrischen Anlagen",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "HGAS1"     => [
            "short" => "Hilfeleistung",
            "long"  => "Gasgeruch",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK"
        ],
        "HGAS2"     => [
            "short" => "Hilfeleistung",
            "long"  => "Unfall mit Gasausströmung",
            "vehicle" =>"LOHELW1,LOHTLF,LOHDLK,LOHHLF"
        ],
        "HGEFAHR1"  => [
            "short" => "Hilfeleistung",
            "long"  => "Unfall mit Chemikalien, größeren Mengen Öl, einzelnen Gebinden(Benzin, Säure o. ä.). Austritt von Gefahrstoff",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "HGEFAHR2"  => [
            "short" => "Hilfeleistung",
            "long"  => "Unfall mit Gefahrstoffaustritt eines Tankfahrzeugs, Tankcontainers, Kesselwaggons",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "HKLEMM1Y"  => [
            "short" => "Hilfeleistung",
            "long"  => "Mehrere Person eingeklemmt in PKW / LKW nach VU, Kfz / Maschine. Mehrere Person verschüttet",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ],
        "HKLEMM2Y"  => [
            "short" => "Hilfeleistung",
            "long"  => "Unfall mit Gefahrstoffaustritt eines Tankfahrzeugs, Tankcontainers, Kesselwaggons",
            "vehicle" =>"LOHELW1,LOHTLF,LOHGWL,LOHHLF"
        ]
    ],
    'districts' => ["OCHSHAUSEN" , "CRUMBACH", "VOLLMARSHAUSEN"],
    'maxStrLenType' => 30
];