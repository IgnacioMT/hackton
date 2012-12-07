<div class="cajaPregunta" >
                     
     <div style="color:#eee; text-shadow:#000 1px 1px 5px; width:380px; line-height:34px; vertical-align:middle;" class="georgiaIt12 titBusq" > 
            1. Introduce un rubro o actividad
     </div>
    
        
        <input class="inputBusq" id="buscar" name="buscar" x-webkit-speech type="search" style="width:250px;" />
        
        <select class="selectBusq" id="cajaSeleccionar" onchange="seleccionar()" >
        <?php
        
            $input = $buscar;
            $words = array(); 
            $sql = "SELECT rubro FROM info_empresa";
            $consulta = mysql_query($sql);
            validar_consulta($consulta);
            while($row = mysql_fetch_array($consulta) )
            {
                $palabras = $row["rubro"];
                $palabras = str_ireplace("."," ",$palabras);
                $palabras = str_ireplace(","," ",$palabras);
                $palabras = str_ireplace(";"," ",$palabras);
                
                $palabras = str_ireplace("("," ",$palabras);
                $palabras = str_ireplace(")"," ",$palabras);
                $palabras = explode(" ",$palabras);
                foreach($palabras as $val) 
                {
                    if(strlen($val)>2)
                    if(!in_array($val,$words))
                    {
                        $words[] = $val;
                        //echo ucfirst(strtolower($val))." * ";
                    }
                }
                
            }
                        
            $shortest = -1;
            $res = "";
            foreach ($words as $word) {
                if(strlen($word)>5) $res[] = $word;
            }
            
            sort($res); 
            
           foreach ($res as $val)
            {
                if($cont!=0) echo ", ";
                $cont++;
                echo "<option>".ucfirst(strtolower(utf8_encode($val)))."</option>";
            }
        
        ?>

        </select>
        
        <script>
            function seleccionar()
            { 
                $("#buscar").val(document.getElementById('cajaSeleccionar').value);
            }
        </script>
     
        <input class="botonBusq" type="submit" value="Buscar" />
     
     <div style="color:#eee; font-size:12px; height:17px; padding:5px;">
        Incluye palabras clave que desearias incluir en la b&uacute;squeda, como por ejemplo: Salud, Educaci&oacute;n, Transporte, Universidad, etc...
     </div>
     
</div>