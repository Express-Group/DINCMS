$(document).ready(function()
{
	//toUnicode(this);

	$("#panjangam_form").validate(
	{
		ignore:[],
		debug: false,
		rules:
		{
			/*txtPanjangamMainHome:
			{
			  required: function() { CKEDITOR.instances.txtPanjangamMainHome.updateElement();}
			},*/
			txtTamilday: { required: true, maxlength: 20 },
			txtTamilyearandmonth: { required: true, maxlength: 40 },
			txtNallaNeramKalai: { required: true, maxlength: 20 },
			txtNallaNeramMalai: { required: true, maxlength: 20 },
			txtRaaguKaalam: { required: true, maxlength: 20 },
			txtYemmakandam: { required: true, maxlength: 20 },
			txtKuligai: { required: true, maxlength: 20 },
			txtThithi: { required: true, maxlength: 100 },
			txtChandrashtam: { required: true, maxlength: 50 },			
			txtMesham: { required: true, maxlength: 20 },	
			txtRishabam: { required: true, maxlength: 20 },	
			txtMidunam: { required: true, maxlength: 20 },	
			txtKadagam: { required: true, maxlength: 20 },	
			txtSimham: { required: true, maxlength: 20 },	
			txtKanni: { required: true, maxlength: 20 },	
			txtThulaam: { required: true, maxlength: 20 },	
			txtViruchigam: { required: true, maxlength: 20 },	
			txtDhanasu: { required: true, maxlength: 20 },	
			txtMagaram: { required: true, maxlength: 20 },
			txtKumbham: { required: true, maxlength: 20 },
			txtMeenam: { required: true, maxlength: 20 },
			txtScheduleDate: { required: true },
			txtNatchatram: { required: true, maxlength: 50 },	
		},
		messages: 
		{
			//txtPanjangamMainHome: { required: "Please enter Panchangam details",},
			txtTamilday: { required: "Please enter tamil day", maxlength: "Not more than 20 characters",},
			txtTamilyearandmonth: { required: "Please enter tamil year and month", maxlength: "Not more than 40 characters",},
			txtNallaNeramKalai: { required: "Please enter nallaneram kalai", maxlength: "Not more than 20 characters",},
			txtNallaNeramMalai: { required: "Please enter nallaneram malai", maxlength: "Not more than 20 characters",},
			txtRaaguKaalam: { required: "Please enter raagu kaalam", maxlength: "Not more than 20 characters",},
			txtYemmakandam: { required: "Please enter yemmakandam", maxlength: "Not more than 20 characters",},
			txtKuligai: { required: "Please enter kuligai", maxlength: "Not more than 20 characters",},
			txtThithi: { required: "Please enter thithi", maxlength: "Not more than 100 characters",},
			txtChandrashtam: { required: "Please enter chandrashtam", maxlength: "Not more than 50 characters",},
			txtMesham: { required: "Please enter mesham rasipalan", maxlength: "Not more than 20 characters",},
			txtRishabam: { required: "Please enter rishabam rasipalan", maxlength: "Not more than 20 characters",},
			txtMidunam: { required: "Please enter midunam rasipalan", maxlength: "Not more than 20 characters",},
			txtKadagam: { required: "Please enter kadagam rasipalan", maxlength: "Not more than 20 characters",},
			txtSimham: { required: "Please enter simham rasipalan", maxlength: "Not more than 20 characters",},
			txtKanni: { required: "Please enter kanni rasipalan", maxlength: "Not more than 20 characters",},
			txtThulaam: { required: "Please enter thulaam rasipalan", maxlength: "Not more than 20 characters",},
			txtViruchigam: { required: "Please enter viruchigam rasipalan", maxlength: "Not more than 20 characters",},
			txtDhanasu: { required: "Please enter danusu rasipalan", maxlength: "Not more than 20 characters",},
			txtMagaram: { required: "Please select magaram rasipalan", maxlength: "Not more than 20 characters",},
			txtKumbham: { required: "Please select kumbham rasipalan", maxlength: "Not more than 20 characters",},
			txtMeenam: { required: "Please select meenam rasipalan", maxlength: "Not more than 20 characters",},
			txtNatchatram: { required: "Please enter Natchatram", maxlength: "Not more than 50 characters",},
			txtScheduleDate: { required: "Please enter date" },
		},
		errorPlacement: function (error, element)
		{
			/*if(element.attr("name") == 'txtPanjangamMainHome')
			{ 
				error.insertAfter($("#panchangammainhome_error"));
			}*/			
			if(element.attr("name") == 'txtScheduleDate')
			{ 
				error.insertAfter($("#date_error"));
			}
			else
			{
				error.insertAfter($("#"+element.attr("name")));
			}
		}
	});
	$("#btnPanchangam").click(function() 
	{
		if($("#panjangam_form").valid())
		{
			var date = $("#txtScheduleDate").val();
			var panchangam_id = $("#panchangam_id").val();
			$.ajax({
				type: "POST",
				data: {"schd_date":date, "panchangamid":panchangam_id},
				url: base_url+"dmcpan/panchangam_manager/check_scheduled_date",
				success: function(data)
				{
					//alert(data);
					if(data == "exists")
					{
						$("#date_error").html("Panchangam details already exists for this scheduled date");
						return false;
					}
					else
					{
						$("#date_error").html("");
						
						var confirm_msg = $("#panchangam_id").val();
						if(confirm_msg !="")
							var confirm_status = confirm("Are you sure you want to update the panchangam details?");
						else
							var confirm_status = confirm("Are you sure you want to add the panchangam details?");
						if(confirm_status==true)
						{
							$("#panjangam_form").submit();
						}
						//$("#brkng_news_form").submit();
					}
				}
			});
			
			
			
		}
	});	
	
	//toUnicode(this);
});

function toUnicode(elmnt)
{
  var next;
 if (elmnt.value.length==elmnt.maxLength)
{
next=elmnt.tabIndex + 1;
//look for the fields with the next tabIndex
var f = elmnt.form;
for (var i = 0; i < f.elements.length; i++)
{
  if (next<=f.elements[i].tabIndex)
  {
    f.elements[i].focus();
    break;
    }
   }
  }
}

/*function textCounter(field,field2,maxlimit)
{
 var countfield = document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value = field.value.substring( 0, maxlimit );
  return false;
 } else {
  countfield.value = maxlimit - field.value.length;
 }
}*/
