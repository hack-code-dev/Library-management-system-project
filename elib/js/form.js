



var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
	  
    }
  };
  
var index=0;
function f(v)
{
	
 if(document.getElementById(v).checked)
 {
	 index++;
	document.getElementById('checkvalues').value+=v+",";
	
	
 }
 else
 {
	 index--;
	 str = document.getElementById('checkvalues').value.replace(v+",","");
	 document.getElementById('checkvalues').value=str;
	 
 }
 if(index!=0)
 {
 document.getElementById("_sub").style.display='block';
 }
 else
 {
	 document.getElementById("_sub").style.display='none';
 }
}