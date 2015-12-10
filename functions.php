<?php
/*
    Fábio Simulator
    Copyright LenilsonJr - falecom@lenilsonjr.com & Rannyeri Rodrigues - rannyerirbatista@gmail.com
*/

header('Content-type: text/html; charset=utf-8');

/*
    Função para exibir bordões de fábio
*/
function showSlogan() {

    $slogans_f = fopen( "txt/slogans.txt", "r" );
    $random = mt_rand( 0, count( file( "txt/slogans.txt" ) ) - 1 );

    if ( $slogans_f ) {

        $i = 0;
        while ( $line = fgets( $slogans_f ) ) {

            if ( $i == $random ) {

                echo $line;

            }

            $i = $i + 1;

        }

    } else {

        echo 'Ops, parece que o Pascalzim parou de funcionar...';

    }

}

/*
    Função para gerar exercicios
*/
function generateExercises( $num, $esp, $inst ) {

    $exercises = [];

    for ( $i = 1; $i <= $num; $i++ ) {


        $str = 'Fazer um programa que ';

        //Geramos o imperativo
        $imp_f  = fopen( "txt/imp.txt", "r" );
        $random = mt_rand( 0, count( file( "txt/imp.txt" ) ) - 1 );
        $e = 0;
        while ( $line = fgets( $imp_f ) ) {

            if ( $e == $random ) {

                $str = $str . $line . ' ';

            }

            $e = $e + 1;

        }
        fclose( $imp_f );

        //Geramos a especificação
        $random = [];
        for ( $u = 1; $u <= $esp; $u++ ) {

            $esp_f  = fopen( "txt/esp.txt", "r" );

            $random_g = mt_rand( 0, count( file( "txt/esp.txt" ) ) - 1 );

            while ( in_array( $random_g, $random ) ) {

                $random_g = mt_rand( 0, count( file( "txt/esp.txt" ) ) - 1 );

            }

            $random[] = $random_g;

            $e = 0;
            while ( $line = fgets( $esp_f ) ) {

                //Aqui geramos um número aleátorio para substituir o %
                $line = str_replace( '%', mt_rand( 2, 99 ), $line );

                if ( $e == end( $random ) ) {

                    if ( $u == $esp ) {

                        $str = $str . ' e ' . $line;

                    } elseif ( $u == 1 ) {

                        $str = $str . $line;

                    } else {

                        $str = $str . ', ' . $line;

                    }


                }

                $e = $e + 1;

            }

            fclose( $esp_f );

        }

        $str = $str . ' e ';

        //Geramos a instrução
        $random = [];
        for ( $u = 1; $u <= $inst; $u++ ) {

            $inst_f = fopen( "txt/inst.txt", "r" );

            $random_g = mt_rand( 0, count( file( "txt/inst.txt" ) ) - 1 );

            while ( in_array( $random_g, $random ) ) {

                $random_g = mt_rand( 0, count( file( "txt/inst.txt" ) ) - 1 );

            }

            $random[] = $random_g;

            $e = 0;
            while ( $line = fgets( $inst_f ) ) {

                if ( $e == end( $random ) ) {

                    if ( $u == $inst ) {

                        $str = $str . ' e ' . $line;

                    } elseif ( $u == 1 ) {

                        $str = $str . $line;

                    } else {

                        $str = $str .', ' . $line;

                    }


                }

                $e = $e + 1;

            }

            fclose( $inst_f );

        }

        $str = $str . ".";
        $str = str_replace( array("\n", "\r"), '', $str );

        $exercises[] = $str;

    }

    return $exercises;
}
