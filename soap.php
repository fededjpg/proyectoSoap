<?php

/**defenimos la uri donde haremos la consulta de los datos */
$webservice_url = "https://www.elguille.info/Net/WebServices/CelsiusFahrenheit.asmx";

/**optenermos los valores enviados por el usuario y validamos si existe
 * dicho dato
 */
$a = isset($_POST['a']) ? $_POST['a'] : '';
$option = isset($_POST['select']) ? $_POST['select'] : '';


switch ($option) {
     /** validamos la seleccion del usuario, si elige Fahrenheit 
      * entrara a esta opcion
     */
    case 'Fahrenheit':
        # code...
         /**validamos si lo que nos envio el usuario no es un dato de tipo
          * string,y si esta condicion se cumple nos regresara al
          *index
          */
        if (!is_string($option)) {
            header('Location:http://soap.test?result=error');
            die();
        }
        /**validamos si lo que nos envio el usuario no es un dato de tipo
          * numerico, y si esta condicion se cumple nos regresara al
          *index
          */
        if (!is_numeric($a)) {
            header('Location:http://soap.test?result=errora');
            die();
        }
         /**una vez que haya pasado nuestra validacion nuestra variable request_param
          * obtendar los siguintes datos para poder enviar los datos a nuestro soap
          */
        $request_param = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <FaC xmlns="http://elGuille/WebServices">
                <valor>' . $a . '</valor>
            </FaC>
        </soap:Body>
    </soap:Envelope>';
        break;
    case 'Celsius':
        # code...
        if (!is_string($option)) {
            header('Location:http://soap.test?result=error');
            die();
        }
        if (!is_numeric($a)) {
            header('Location:http://soap.test?result=errora');
            die();
        }

        $request_param = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"
        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <CaF xmlns="http://elGuille/WebServices">
                <valor>' . $a . '</valor>
            </CaF>
        </soap:Body>
    </soap:Envelope>';
        break;

    default:
        # code...
         /**en caso de que el usuario nos haya enviado en su seleccion
          * un dato que no sea Fahrenheit o Celsius nos redireccionara
          * a nuestro index
          */
        header('Location:http://soap.test?result=error');
        die();
        break;
}


$headers = array(
    'Content-Type: text/xml; charset=utf-8',
    'Content-Length: ' . strlen($request_param)
);

$ch = curl_init($webservice_url);// Inicia sesión cURL
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//hacemos la peticion
curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);//codificará los datos 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//true para devolver el resultado sin tratar CURLOPT_RETURNTRANSFER está activado.

$data = curl_exec($ch);//Ejecuta la sesión cURL
$result = $data;

if ($result === FALSE) {
    printf(
        "CURL error (#%d): %s<br>\n",
        curl_errno($ch),
        htmlspecialchars(curl_error($ch))
    );
}

curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Resultado</title>
</head>
<style>
    body {
        background-color: #E4EAFF;
    }
</style>

<body>

    <div class="flex h-screen justify-center items-center">
        <div class="text-center shadow-lg rounded-lg text-5xl">
            <!-- ⬅️ THIS DIV WILL BE CENTERED -->
            <?php if ($option === "Celsius") {
                echo $a . ' Celsius = ' . $data . ' Fahrenheit';
            }
            if ($option === "Fahrenheit") {
                echo $a . ' Fahrenheit = ' . $data . 'Celsius';
            }

            ?>

            <div class="pb-4">
                <a href="http://soap.test/" type="button" class="w-1/2 mt-4 bg-transparent hover:shadow-inner hover:bg-gray-100 text-blue-700 font-semibold py-2 px-4  shadow rounded cursor-pointer outline-none focus:outline-none focus:shadow-outline">Regresar &#x1f3da;</a>
            </div>
        </div>


    </div>
</body>

</html>