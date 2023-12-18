<?php
//variables
$apellidos ="Talla Saravia";
$nombres="Alexis Alexander";

//constantes
define("DNI","71592495");

//echo $apellidos ."". $nombres . "" . DNI;

//arreglos
$amigos = array("Karina","Melissa","Vania","Emily","Sheyla");
$paises = ["Perú", "Argentina", "Venezuela", "Brasil"];
/* forma 1 *///echo $amigos[0]; // un print
/* Forma 2 *///var_dump($amigos);//se usa para usar pruebas o debug
/* forma 3 */
//foreach($amigos as $amigo){ //el primero es una variable y el segundo donde se almacena la variable
//    echo $amigo;
//}
/* forma 4 */
$softwares = [
    ["Eset", "Avast","Windows","Windows Defender","Avira","Karspersky"],
    ["Warzone","God of Wars","Valorant","Pepsiman","MarioBross"],
    ["VSCode","NetBeans","AndroidStudio","PSeint"]
];
/* echo $softwares[0][3]."<br>";
echo $softwares[2][0]."<br>";
echo $softwares[2][2]."<br>";
echo $softwares[1][0]."<br>"; */
/* foreach($softwares as $software){
    foreach($software as $software1){
        echo $software1 . "<br>";
    }
} */
//Arreglo asociativo (sin índice)
/* $catalogo = [
    "so"=>"Windows 10",
    "antivirus"=>"Panda",
    "utilitario"=>"WinRar",
    "videojuego"=>"MarioBross"
];
echo $catalogo ["utilitario"]; */
//ARREGLO 4
$desarrollador = [
    "datospersonales" => [
        "apellidos" => "Talla Saravia",
        "nombres" => "Alexis Alexander",
        "Edad" => 39,
        "telefono" => ["956807318","950470224"]
    ],
    "formacion" => [
        "inicial" =>["Formacion de tilines"],
        "primaria" => ["San jose","José Marti"],
        "Secundaria" => ["San Pedro"]
    ],
    "habilidades" =>[
        "bd" => ["MySQL","MSSQL","MongoDB"],
        "Frameworks" => ["Laravel","CodeIgniter","Hibernite","Zend"]
    ]
];
/* echo "<pre>";
var_dump($desarrollador);
echo "<pre>"; */

echo json_encode($desarrollador);
