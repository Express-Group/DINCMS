$(document).ready(function()
{
	
	$("#dailyPredictions_form").validate(
	{
		ignore:[],
		debug: false,
		rules:
		{
			txtPredictionDetails:
			{
			  required: function() { CKEDITOR.instances.txtPredictionDetails.updateElement();}
			},
			number_id: { required: true},
			prediction_date: { required: true },	
		},
		messages: 
		{
			txtPredictionDetails: { required: "Please enter Daily Predictions",},
			number_id: { required: "Please select Number list",},
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
	$("#btnDailyPrediction").click(function() 
	{
		if($("#dailyPredictions_form").valid())
		{
			var number_id = ($("#number_id").val() !='') ? $("#number_id").val() : "";
			var prediction_id = ($("#hidden_id").val() !='') ? $("#hidden_id").val() : "";
			var date = $("#prediction_date").val();
			$.ajax({
				type: "POST",
				data: {"number_id":number_id, "schd_date":date, "prediction_id":prediction_id},
				url: base_url+"dmcpan/numerology_daily_prediction/check_alreadyExists",
				success: function(data)
				{
					//alert(data);
					if(data == "exists")
					{
						$("#already_error").html("Numerology-Daily Predictions already exists for this Date!");
						return false;
					}
					else
					{
						$("#date_error").html("");
						
						var confirm_msg = $("#hidden_id").val();
						if(confirm_msg !="")
							var confirm_status = confirm("Are you sure you want to update the Numerology-Daily Predictions?");
						else
							var confirm_status = confirm("Are you sure you want to add the Numerology-Daily Predictions?");
						if(confirm_status==true)
						{
							$("#dailyPredictions_form").submit();
						}
						
					}
				}
			});
			
			
			
		}
	});	
	
});