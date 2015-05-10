 function goBack(){
      window.history.back();
 };
 
 function showDivbyID(ide){
       		document.getElementById("regSede").style.display='none';
       		document.getElementById("regCurso").style.display='none';
       		document.getElementById("regFranja").style.display='none';
       		document.getElementById("regGrupo").style.display='none';
       		document.getElementById("regGrupo").style.display='none';
       		document.getElementById(ide).style.display='block';
 };

 function habilitarTextBox(checkBool, textID) {
            for (var i = 0; i < textID.length; i++) {
                textFldObj = document.getElementById(textID[i]);
                textFldObj.disabled = !checkBool;
                if (!checkBool) { textFldObj.value = ''; }
  };