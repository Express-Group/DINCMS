$(document).ready(function()
{
	
	$("#generalPredictions_form").validate(
	{
		ignore:[],
		debug: false,
		rules:
		{
			txtPredictionDetails:
			{
			  required: function() { CKEDITOR.instances.txtPredictionDetails.updateElement();}
			},
			raasi_name: { required: true},
			prediction_date: { required: true },	
		},
		messages: 
		{
			txtPredictionDetails: { required: "Please enter General Predictions",},
			raasi_name: { required: "Please select Raasi Name",},
			prediction_date: { required: "Please enter date" },
		},
		errorPlacement: function (error, element)
		{
			if(element.attr("name") == 'txtPredictionDetails')
			{ 
				error.insertAfter($("#predictiondetails_error"));
			}			
			else if(element.attr("name") == 'prediction_date')
			{ 
				error.insertAfter($("#date_error"));
			}
			else
			{
				error.insertAfter($("#"+element.attr("name")));
			}
		}
	});
	$("#btnGeneralPrediction").click(function() 
	{
		if($("#generalPredictions_form").valid())
		{
			var raasi_id = ($("#raasi_name").val() !='') ? $("#raasi_name").val() : "";
			var prediction_id = ($("#hidden_id").val() !='') ? $("#hidden_id").val() : "";
			$.ajax({
				type: "POST",
				data: {"raasi_id":raasi_id, "prediction_id":prediction_id},
				url: base_url+"dmcpan/astro_general_prediction/check_alreadyExists",
				success: function(data)
				{
					//alert(data);
					if(data == "exists")
					{
						$("#already_error").html("Astrology-General Predictions already exists");
						return false;
					}
					else
					{
						$("#date_error").html("");
						
						var confirm_msg = $("#hidden_id").val();
						if(confirm_msg !="")
							var confirm_status = confirm("Are you sure you want to update the Astrology-General Predictions?");
						else
							var confirm_status = confirm("Are you sure you want to add the Astrology-General Predictions?");
						if(confirm_status==true)
						{
							$("#generalPredictions_form").submit();
						}
						
					}
				}
			});
			
			
			
		}
	});	
	
});