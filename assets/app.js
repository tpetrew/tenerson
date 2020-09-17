function getusersPage() {
	$.getJSON('http://tpetrew.moscow/lastposts/getprofiles').success(function(data) {
		console.log(data);

		var html_profiles = '';
		var html_posts = '';
		html_profiles = '<div class="circle__profile" onmousedown="newPerson()" style="cursor: pointer;">'+
						'<div class="circle">+</div>'+
						'<div class="circle-under__name" style="color: #FF1058">New</div>'+
						'</div>';
					

		if(data){

			for(var i in data){

				html_profiles=html_profiles+'<div class="circle__profile">'+ 
											'   <div class="circle"><img src="'+ data[i].userpic +'"></div>'+
											'   <div class="circle-under__name">'+ data[i].username +'</div>'+
											'</div>';
					
				var description = '';
				if(data[i].description===null){

					description = '';

				} else {

					description = description+'<span>'+ data[i].username +':</span>'+ data[i].description;

				}

				if(data[i].type==='sidecar'){
					var html_posts_src = '';
					src = data[i].src;
					console.log(src);
					for(var j in src){
						if(j===0) {
							html_posts_src = html_posts_src + '<div class="post__media__img">'+
										 				  '<img src="'+src[j]+'">'+
										 				  '<div class="type"><img src="assets/images/iPhone 11 Pro/24/basic/layers.svg"></div></div>';
						} else {
						html_posts_src = html_posts_src + '<div class="post__media__img">'+
										 				  '<img src="'+src[j]+'"></div>';
						}
					}
				} else if(data[i].type==='image') {
					var html_posts_src = '';
					html_posts_src = html_posts_src + '<div class="post__media__img">'+
										 				  '<img src="'+data[i].preview_standart+'">'+
										 				  '</div>';
				} else if(data[i].type==='video') {
					src = data[i].src;
					var html_posts_src = '';
					for(var j in src){
						html_posts_src = html_posts_src + '<div class="post__media__img">'+
										 				  '<video controls="controls"><source src="'+src[j]+'" type="video/mp4"></video>'+
										 				  '</div>';
					}
					
				}


 


				html_posts=html_posts + '<div class="post">'+
				        				'<div class="post__owner-box"><div class="owner">'+
				        				'<div class="owner__photo"><img src="'+ data[i].userpic +'"></div>'+
				        				'<div class="owner__name-place">'+
				        				'<div class="name">'+ data[i].username +'</div>'+
				        				'<div class="place">'+ data[i].location_name +'</div>'+
				        				'</div></div>'+
				        				'<div class="settings"><img src="assets/images/iPhone 11 Pro/24/basic/more-vertical.svg" onmousedown="deletePerson('+i+')"></div></div>'+
				        				'<div class="post__media"><div class="posts-scroll">'+html_posts_src+


				        				'</div></div><div class="post__info">' +description +
				        				'<p>'+data[i].created_at+'</p>'+
				        				'</div></div>';
    		}
    	} 
    				
    	document.querySelector('.profiles-circle__wrapper').innerHTML = html_profiles;
    	document.querySelector('.posts-layout').innerHTML = html_posts;

	});
};


function deletePerson(person_id){

  	document.getElementById("delete-person__wrapper").style.display = "flex";
  	document.getElementById("delete-person__wrapper__phone").style.display = "flex";
  	document.getElementById("delete-person").style.display = "block";
  	var elements = "'";
  	var delete_link = '<span onmousedown="deletePersonId('+person_id+')">Удалить пользователя</span>';
  	document.querySelector('#delete_person_id').innerHTML = delete_link;

};


function deletePerson_hide(){
  	document.getElementById("delete-person__wrapper").style.display = "none";
};


function newPerson(){
  	document.getElementById("new-person__wrapper").style.display = "flex";
  	document.getElementById("new-person__wrapper__phone").style.display = "flex";
  	document.getElementById("new-person").style.display = "block";
};


function newPerson_hide(){
  	document.getElementById("new-person__wrapper").style.display = "none";
};


function closeMessage(){
	document.getElementById("message").style.display = "none";
};


function deletePersonId(delete_id) {
	$.ajax({
		url: 'http://tpetrew.moscow/lastposts/delete',
		method: 'get',
		data: {"delete_id": delete_id},
		success: function(data){
			$('#message').html(data);
		}
	});
	document.getElementById("delete-person__wrapper").style.display = "none";
	getusersPage();
};


$("#newperson").on("submit", function(){
	$.ajax({
		url: 'http://tpetrew.moscow/lastposts/new',
		method: 'post',
		dataType: 'text',
		data: $(this).serialize(),
		success: function(data){
			$('#message').html(data);
		}
	});
});




