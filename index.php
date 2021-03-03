<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Cosumir Soap</title>
</head>

<body class="bg-gray-200">
    <section class="container mx-auto text-5xl text-center pb-4">
        <h1>Cliente Soap</h1>
    </section>

    <section class="container mx-auto py-4 shadow-xl w-1/3 text-center bg-gray-50 rounded-lg">
        <form action="soap.php" method="POST">
            <input type="text" class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-11/12" name="a" id="data"  required placeholder="ingresar primer valor">
            <?php if (isset($_GET['result'])) :
                $result = $_GET['result'];
                if ($result == "errora") : ?>
                    <p class="text-red-600">El valor ingresado no es un numero</p>
            <?php
                endif;
            endif;
            ?>
            <select name="select" class="px-3 mt-4 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-11/12">
                <option value="Celsius">Grado Celsius</option>
                <option value="Fahrenheit">Grado Fahrenheit</option>
            </select>
            <?php if (isset($_GET['result'])) :
                $result = $_GET['result'];
                if ($result == "error") : ?>
                    <p class="text-red-600">El valor ingresado no existe</p>
            <?php endif;
            endif; ?>
            <input type="submit" class="w-1/2 mt-4 bg-transparent hover:shadow-inner hover:bg-gray-100 text-blue-700 font-semibold py-2 px-4 shadow rounded cursor-pointer outline-none focus:outline-none focus:shadow-outline" value="Enviar  &#x1f4e4;">
        </form>
    </section>

</body>


</html>


<script>
    let input = document.querySelector('#data');
    input.oninvalid = function(event) {
        event.target.setCustomValidity('Ingres un dato numerico por favor 😁.');
    }
</script>