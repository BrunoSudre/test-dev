<?php
    session_start();
    header('Content-type: application/json');

    $carros = json_decode(file_get_contents('Carro.json.json'), true);
    $path = explode('/', $_GET['path']);

    if (count($path[0]) == 0 || $path == "") {
        die('Incorrect path!');
    }

    $parametro = null;

    if (count($path) > 1) {
        $parametro = $path[1];
    } 

    $verbo = $_SERVER['REQUEST_METHOD'];
    $pathExists = carros[$path[0]];
    $input = file_get_contents('php://input');

    $newCarro = json_decode($input, true);
    $newCarro['id'] = count($carros['carros']) + 1;

    switch($verbo) {
    
        case 'GET':
            if ($pathExists) {
                if (empty($parametro)) {
                    echo json_encode($carros);
                } else {
                    $encontrado = null;                    
                    foreach ($carros[$path[0]] as $carro) {
                        if ($carro['id'] == $parametro) {
                            $encontrado = true;
                            echo json_encode($carro);
                        }
                    }
                    if (empty($encontrado)) {
                        die('[]');
                    }
                }
            } else {
                pathNotExists();
            }

            break;
        
        case 'POST':
            if ($pathExists) {
                $carros[$path[0]][] = $newCarro;
                file_put_contents('Carro.json.json', json_encode($carros));
                echo file_get_contents('Carro.json.json');
            } else {
                pathNotExists();
            }

            break;
        
        case 'PUT':
            if ($pathExists) {
                if ($parametro) {
                    foreach ($carros[$path[0]] as $carro) {
                        if ($carro['id'] == $parametro) {
                            $carro = $newCarro;
                            $carro['id'] == $parametro;
                        }
                    }
                    file_put_contents('Carro.json.json', json_encode($carros));
                    echo file_get_contents('Carro.json.json');
                }
            } else {
                pathNotExists();
            }

            break;
        
        case 'DELETE':
            if ($pathExists) {
                if ($parametro) {
                    foreach ($carros[$path[0]] as $key => $carro) {
                        if ($carro['id'] == $parametro) {
                            unset($GLOBALS['carros'][$path[0]][$key]);
                        }
                    }                 
                    file_put_contents('Carro.json.json', json_encode($carros));
                    echo file_get_contents('Carro.json.json');
                }
            } else {
                pathNotExists();
            }
            break;
        
        default:
            die('Verbo HTTP inválido!');
            break;
    }

    function pathNotExists() 
    {
        die('ERROR! PATH NOT EXISTS');
    }
?>