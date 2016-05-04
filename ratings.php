<?php

include("funciones.php");

    // se crea un nuevo objeto y le pasamos el id de la película que vino por el postback
    $rating = new ratings($_POST['pelicula_id']);

    // si en el postback se indicó la variable buscar, obtenemos los ratings, sino guardamos el voto
    isset($_POST['buscar']) ? $rating->obtenerRating() : $rating->votar();
    
    // definición de la clase
    class ratings {
        
        // el archivo donde guardamos los datos
        //var $data_file = './ratings.data.txt';
		
        private $pelicula_id;
        private $data = array();
        
        // el constructor de la clase va a recibir la película
        function __construct($peli) {
                
            // guardamos la película en la propiedad
           echo $this->pelicula_id = $peli;

            // file_get_contents devuelve lo que está en el archivo de texto a una variable string
            //echo $info = file_get_contents($this->data_file);
            
            // si se cargó el archivo
          /*  if($info) {

                // transformamos los datos planos a un array en php
               $this->data = unserialize($info);
			   echo '<pre>';
			   print_r($this);
			   echo '</pre>';
            }*/
        }


        public function obtenerRating() {

            // si en el arreglo con los datos del archivo txt (que se cargó en el constructor), está el id de la película
         //   echo $this->data[$this->pelicula_id];
		//	echo $_GET['pelicula_id'];
        //    if($this->data[$this->pelicula_id]) {
$id = $_GET['pelicula_id'];
				if($id) {

connect_to_db();

 $resultado = mysql_query("SELECT rating FROM monitoreoti WHERE id='$id'");
	if (!$resultado) {
    die('Consulta no válida: ' . mysql_error());
	}
	while ($row = mysql_fetch_object($resultado)) {
			$ratingdb=$row->rating;
			}mysql_free_result($resultado);

                // devolvemos los datos de la película por JSON a la pagína
                
                
                $data['pelicula_id'] = $this->pelicula_id;
                $data['numeroDeVotos'] = $ratingdb;
                $data['votosTotales'] = $ratingdb;
                $data['promedioExacto'] = $ratingdb;
                $data['promedioRedondeado'] = $ratingdb;

                // devolvemos el objeto recién creado por JSON a la página
                echo json_encode($data);
                
                
               // echo json_encode($this->data[$this->pelicula_id]);
            }
            else { // caso contrario

                // cargamos los datos de la película al arreglo, con los valores por defecto
                $data['pelicula_id'] = $this->pelicula_id;
                $data['numeroDeVotos'] = 0;
                $data['votosTotales'] = 0;
                $data['promedioExacto'] = 0;
                $data['promedioRedondeado'] = 0;

                // devolvemos el objeto recién creado por JSON a la página
                echo json_encode($data);
            } 
        }

        public function votar() {
            
            // necesitamos saber qué estrella es la que se votó
            // para eso, usamos preg_match, que realiza una comparación 
            // tomando la expresión regular, la cadena de entrada (la estrella en la que hizo click) y dejando el resultado en $resultado
           /* preg_match('/estrella_([1-5]{1})/', $_POST['clickEstrella'], $resultado);

            // guardamos el valor de la estrella
            $votar = $resultado[1];
            
            $ID = $this->pelicula_id;
            
            // si existe la película en el arreglo (cargado en el constructor)
            if($this->data[$ID]) {

                // aumentamos el número de votos en 1
                $this->data[$ID]['numeroDeVotos'] += 1;

                // sumamos el voto a los votos totales
                $this->data[$ID]['votosTotales'] += $votar;
            }
            else { // si no existe la película

                // indicamos que es el primer voto
                $this->data[$ID]['numeroDeVotos'] = 1;

                // indicamos el número del primer voto
                $this->data[$ID]['votosTotales'] = $votar;
            }
            
            // calculamos el promedioExacto
            $this->data[$ID]['promedioExacto'] = 
                round( $this->data[$ID]['votosTotales'] / $this->data[$ID]['numeroDeVotos'], 1 );

            // redondeamos el promedio, para no tener que volver a hacerlo en la página
            $this->data[$ID]['promedioRedondeado'] = round( $this->data[$ID]['promedioExacto'] );
                
            // guardamos el arreglo en formato plano de nuevo en el archivo de texto
            file_put_contents($this->data_file, serialize($this->data));

            // obtenemos el nuevo rating para enviárselo a la página
            $this->obtenerRating();*/
        }
    }
?>