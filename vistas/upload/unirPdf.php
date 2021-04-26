<?php

require_once "vendor/autoload.php";
use iio\libmergepdf\Merger;

if(isset($_GET['id'])){
/*=====================================================
Unir los pdf de solicitud de arbitraje ya validando si exiten los pdf
=======================================================*/
  
    $array=explode(',',$_GET['id']);

    $merger = new Merger;
 
    $longitud = count($array);
   
    for($i=0; $i<($longitud-1); $i++)
        {
            /*=====================================================
            Validadando la existencia de un pdf
            =======================================================*/
            if(is_readable($array[$i]))
            {
                try {

                        $merger->addFile($array[$i]);
                    
                    } catch (Exception $e) 
                    {
                        echo "Se ha producion una excepción. Los detalles son los siguientes:";
                        var_dump($e);
                    }

            }else{
                echo "error";
            }
                        

        }
    /*=====================================================
        Capturando los errores que se encuentras al unir pdf con try catch.
    =======================================================*/
    try 
    {
        $createdPdf = $merger->merge();
        $nombreArchivo = "anexos.pdf";

        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=$nombreArchivo");
        echo $createdPdf;

        if (!isset($_SESSION['errorUnidPdf'])) 
        {
            unset($_SESSION['errorUnidPdf']);
        }
       
        exit;
    }
    catch (Exception $e) 
    {
        /*=====================================================
        Si encuentra un error, en algun pdf, no generara el combinado de los anexo, tienes que corregir el pdf
        =======================================================*/
       
        echo "<div style='text-align: center;background: #f9abab;font-size: 19px;border: 2px solid #6f6868;'>Error, documento dañado corregir para poder combinar los pdf del anexo</div>";
        
        echo "<script languaje='javascript' type='text/javascript'>
                setTimeout(function()
                {
                    window.close();

                },3000);
            </script>";

        exit;

    }
    
    

}