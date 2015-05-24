<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function() {

    //let's create arrays
        var semestre = [
            {display: "1", value: "1"},
            {display: "2", value: "2"}];

        var cuatrimestre = [
            {display: "1", value: "1"},
            {display: "2", value: "2"},
            {display: "3", value: "3"}];

        var bimestre = [
            {display: "1", value: "1"},
            {display: "2", value: "2"},
            {display: "3", value: "3"},
            {display: "4", value: "4"},
            {display: "5", value: "5"},
            {display: "6", value: "6"}];
        $("#modalidad").change(function() {
            var parent = $(this).val();
            switch (parent) {
                case 'semestre':
                    list(semestre);
                    break;
                case 'cuatrimestre':
                    list(cuatrimestre);
                    break;
                case 'bimestre':
                    list(bimestre);
                    break;
                default: //default child option is blank
                    $("#tiempo").html('');
                    break;
            }
        });

        function list(array_list)
        {
            $("#tiempo").html(""); //reset child options
            $(array_list).each(function(i) { //populate child options 
                $("#tiempo").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
            });
        }

    });
</script>

<div class="well well-lg">
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <label for="critero"> Modalidad</label>
        <select class="form-control" name="modalidad" id="modalidad">                        
            <option>Seleccione</option>
            <option value="semestre">Semestre</option>
            <option value="cuatrimestre">Cuatrimestre</option>
            <option value="bimestre">Bimestre</option>
        </select>

        <label for="critero"> N&uacute;mero</label>
        <select class="form-control" name="tiempo" id="tiempo">
        </select>

        <label for="critero"> Per&iacute;odo lectivo</label>
        <select class="form-control" name="periodoLectivo" id="periodoLectivo">
            <option>2013</option>
            <option>2014</option>
            <option selected>2015</option>
            <option>2016</option>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
        </select>

        </br>  
        <input type="hidden" id="operation" name="operation" value="reg_Asignacion">
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>