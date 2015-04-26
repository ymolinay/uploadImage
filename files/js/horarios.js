
$(document).ready(function () {
	$( "#carrera" ).on( "change", function() {
		$('#seccion option').remove();
		$('#seccion').append('<option value="">-- Sección --</option>');
    var valor= $( "#carrera" ).val().toUpperCase() ;
	var l = valor.substr(0,1);
	l=(l==='C')? valor.substr(0,1)+valor.substr(3,1):l;
		for (i= 1; i<=6; i ++)
		{
			for (j=1;j<=3;j++)
			{
				if(j==1){t='M'}
				if(j==2){t='T'}
				if(j==3){t='N'}
				for(h=1;h<=2;h++)
				{
					if(j==1){s='I'}
					if(j==2){s='II'}
					if(j==3){s='III'}
					seccion = i+t+'E'+l+s;
					$('#seccion').append('<option value="'+seccion+'">'+seccion+'</option>');
				}
			}
		}
});
$( "#seccion" ).on( "change", function() {
	$('#docente').removeAttr("disabled");
	$('#dia').removeAttr("disabled");
	$('#aula').removeAttr("disabled");
	$('#curso').removeAttr("disabled");
	var t= $( "#seccion" ).val().substr(1,1) ;
	$('#hora option').remove();
	$('#hora').append('<option value="">-- Hora --</option>');
	if(t=='M')
	{

			$('#hora').append('<option value="1">08:00:00-08:50:00</option>');
			$('#hora').append('<option value="2">08:50:00-09:40:00</option>');
			//$('#hora').append('<option value="09:40:00-10:10:00">09:40:00-10:10:00</option>');
			$('#hora').append('<option value="4">10:10:00-11:00:00</option>');
			$('#hora').append('<option value="5">11:00:00-11:50:00</option>');
			
	}
	if(t=='T')
	{

			$('#hora').append('<option value="6">02:00:00-02:50:00</option>');
			$('#hora').append('<option value="7">02:50:00-03:40:00</option>');
			//$('#hora').append('<option value="03:40:00-04:10:00">03:40:00-04:10:00</option>');
			$('#hora').append('<option value="9">04:10:00-05:00:00</option>');
			$('#hora').append('<option value="10">05:00:00-05:50:00</option>');
			
	}
	if(t=='N')
	{

			$('#hora').append('<option value="11">06:00:00-06:50:00</option>');
			$('#hora').append('<option value="12">06:50:00-07:40:00</option>');
			//$('#hora').append('<option value="07:40:00-08:10:00">07:40:00-08:10:00</option>');
			$('#hora').append('<option value="14">08:10:00-09:00:00</option>');
			$('#hora').append('<option value="15">09:00:00-09:50:00</option>');
			
	}
	$('#hora').removeAttr("disabled");
	});


$( "#generar" ).on( "click", function() {
	$( "#horario" ).css('display','none') ;
	var t = $( "#seccion" ).val().substr(1,1);
	if(t=='M'){
			$( "#mhorario" ).css('visibility','visible')
			$( "#mhorario" ).css('display','inline')
			$( "#thorario" ).css('visibility','hidden')
			$( "#thorario" ).css('display','none') 
			$( "#nhorario" ).css('visibility','hidden')
			$( "#nhorario" ).css('display','none') 
	}
	if(t=='T'){
			$( "#thorario" ).css('visibility','visible')
			$( "#thorario" ).css('display','inline')
			$( "#mhorario" ).css('visibility','hidden')
			$( "#mhorario" ).css('display','none') 
			$( "#nhorario" ).css('visibility','hidden')
			$( "#nhorario" ).css('display','none') 
	}
	if(t=='N'){
			$( "#nhorario" ).css('visibility','visible')
			$( "#nhorario" ).css('display','inline')
			$( "#mhorario" ).css('visibility','hidden')
			$( "#mhorario" ).css('display','none') 
			$( "#thorario" ).css('visibility','hidden')
			$( "#thorario" ).css('display','none') 
	}
	var id = $('#dia').val() + $('#hora').val();
	var html =$('#curso').val() + ' </br>' +$('#aula').val() + ' </br>'+$('#docente').val() + '<br/><button onclick=quitar("'+id+'") type="button" class="btn btn-sm btn-warning">Quitar</button>';
	
	$( "#"+id ).html(html);
});
});
function quitar(id){
$( "#"+id ).html('');
}