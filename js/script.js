window.onscroll = function() {myFunction()};

function myFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    $(".header-nav").css("background-color", " #0072ff ");
    $(".navbar-brand").css("font-size","2rem")
  } else {
    $(".header-nav").css("background-color", " transparent ");
  }
}


// Keep Selected tab on refresh
$('a[data-toggle="tab"]').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});

$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href");
    localStorage.setItem('selectedTab', id)
});


var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab != null) {
    $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
}


// toggle add data forms
$(document).ready(function(){
$("#student_head").click(function(){
  $("#add_student").slideToggle("medium");
}); 
});

$(document).ready(function(){
$("#schedule_head").click(function(){
  $("#add_schedule").slideToggle("medium");
}); 
});



function rtrim(str, ch) // to trim specified char from right side
{
    for (i = str.length - 1; i >= 0; i--)
    {
        if (ch != str.charAt(i))
        {
            str = str.substring(0, i + 1);
            break;
        }
    } 
    return str;
}


// function input box multiple selector

function multiple_selector(input_box,selected_list,hidden_input){


			input_box.keyup(function(e){

				var reader			=	input_box.val();
				var comma			=	reader.lastIndexOf(",");


				if (e.which==188 || $comma!=-1 ) {
					
					var value 			= 	rtrim(reader,",");

					selected_list.append('<li class="list-values">'+value+'<i class="fas value-close fa-times"></i></li>');

					hidden_input.val(hidden_input.val()+value+",");

					input_box.val('');
							}
				});
		
		// Input multiple Box on delete 
		$(document).on("click", ".value-close", function() {
			var remove_from		=	hidden_input;
			var to_remove		=	$(this).parent().text();
		   	var to_replace		=	remove_from.val();
		    var replaced		=	to_replace.replace(to_remove+",","");   
			
			remove_from.val(replaced);

		   	$(this).parent().remove();
		});
}

multiple_selector($("#sub-selector"),$("#sub-values-list ul"),$("#hidden-sub"));
multiple_selector($("#course-selector"),$("#course-values-list ul"),$("#course-hidden"));

//function select all
function check_all()
{
	var items	=	document. getElementsByClassName('check');
	for (var i = 0; i <= items.length ; i++) {
			
				items[i].checked = true;
				
	}
}

//function unselect all
function uncheck_all()
{
	var items	=	document.getElementsByClassName('check');
	for (var i = 0; i <= items.length ; i++) {
			
				items[i].checked = false;
			
	}
}

//jelly effect on click
$(function(){

	$('.check-container').on("click", function () {
	$(this).addClass("jelly");
	setTimeout(remove_class,800);
	});

	function remove_class() {
	$('.check-container').removeClass("jelly");
	}
});


//show div on scroll
function scroll_effect(element){
$(window).scroll(function() {
    var top_of_element = element.offset().top;
    var bottom_of_element = element.offset().top + element.outerHeight();
    var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
    var top_of_screen = $(window).scrollTop();

    if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
    	element.css("transform","rotatey(0deg)");
    } else {
        element.css("transform","rotatey(180deg)");
    }
});
}


scroll_effect($(".home h1"));