<div class="cajaPregunta2" >
                     
     <div style="color:#eee; text-shadow:#000 1px 1px 5px; width:380px; line-height:34px; vertical-align:middle;" class="georgiaIt12 titBusq" > 
            2. &iquest;Alguna direcci&oacute;n en especial?
     </div>
        <input class="inputBusq" id="buscarDir" name="buscarDir" value="<?php if(isset($_POST["buscarDir"])) echo $_POST["buscarDir"]; ?>" x-webkit-speech type="search" />
        <input class="botonBusq" type="button" value="Buscar" onclick="cargarDireccion();" />
        <div class="bt_opciones" style="float:right; margin:3px 30px 0 0;" onclick="$('#infoAdicional').slideToggle(400);"></div>
        
        
        
        <div id="infoAdicional" style="display:none; clear:both; color:#fff;" class="georgiaIt14">
            <div style="float:left; margin:10px;">
                <div style="width:100px;"> Ciudad:</div>
                <input class="inputBusq" id="ciudad" name="ciudad" x-webkit-speech type="search" style="width:250px;" value="<?php if(isset($_POST["ciudad"])) echo $_POST["ciudad"]; else echo "La Paz"; ?>" />
            </div>
            
            <div style="float:left; margin:10px;">
                <div style="width:100px;"> Departamento/Provincia:</div>
                <input class="inputBusq" id="dep" name="dep" x-webkit-speech style="width:250px;" type="search" value="<?php if(isset($_POST["dep"])) echo $_POST["dep"]; else echo "La Paz"; ?>" />
            </div>
            
            <div style="float:left; margin:10px;">
                <div style="width:100px;"> Pais:</div>
                <select class="selectBusq" id="pais" name="pais" style="width:250px; height:30px; margin-top:2px;" onchange="seleccionar()" >
                    <option <?php if(isset($_POST["pais"])&&$_POST["pais"]=="Bolivia") echo 'selected="selected"'; ?> >Bolivia</option>
                    <option <?php if(isset($_POST["pais"])&&$_POST["pais"]=="Argentina") echo 'selected="selected"'; ?> >Argentina</option>
                </select>
            </div>
            <div style="clear:both;"></div>
        </div> 
            
     <script>
        function cargarDireccion()
        {
            var url = 'mapa.php?d=1&dir='+encodeURI($("#buscarDir").val())+
                                  '&ciudad='+encodeURI($('#ciudad').val())+
                                  '&dep='+encodeURI($('#dep').val())+
                                  '&pais='+encodeURI($('#pais').val());
            var url2 = url + '&r=' + Math.random()*99999;
            document.getElementById('geolocalizar').src = '';
            document.getElementById('geolocalizar').src = url2;
        }
     </script>
     
     <iframe id="geolocalizar" src="geolocalizar.php" scrolling="no" frameborder="0" style="border:0; margin-top:15px; width:950px; height:250px;"></iframe>
     
     <div style="color:#eee; font-size:12px; height:17px; padding:5px;">
        Su ubicaci&oacute;n actual se determina autom&aacute;ticamente, pero puede corregirla arrastrando el marcador a cualquier parte del mapa.
     </div>
     <div id="geoPos" style="color:#fff; font-size:12px; height:17px; padding:5px;"></div>
     
     <input type='text' name="markerLat1" id='markerLat' value='<?php if(isset($_POST["markerLat1"])) echo $_POST["markerLat1"]; ?>' />
     <input type='text' name="markerLng1" id='markerLng' value='<?php if(isset($_POST["markerLng1"])) echo $_POST["markerLng1"]; ?>' />
     
</div>