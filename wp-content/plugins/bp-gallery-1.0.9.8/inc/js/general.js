//helper global object for bp-gallery

 var BpGalleryHelper={
 // Hide update message, what about error handing bro
hide_message:function (){
    jQuery("#message").empty();
    jQuery("#message").removeClass();
}
,
// Show Update Message, need some update as red:D for error handing, currently everything is green
 show_message:function (msg,error){
   if(error==undefined||!error)
   jQuery("#message").addClass("updated").addClass("fade");
   else
       jQuery("#message").addClass("error");

   jQuery("#message").html("<p>"+msg+"</p>");

},
get_id:function(el){
    var eid=el.id;
    var beg=eid.lastIndexOf('_');//dom id is somename_something_idofgallery/media
    var id=eid.slice(beg+1);
    return id;

}
,
/**
 * @desc Get a query variable's value from the url
 * url must be of the form http://example.com/abc/xyz/?name=val&name1=val2..
 */

get_var_in_url:function(url,name){
    var urla=url.split("?");
    var qvars=urla[1].split("&");//so we hav an arry of name=val,name=val
    for(var i=0;i<qvars.length;i++){
        var qv=qvars[i].split("=");
        if(qv[0]==name)
            return qv[1];
      }
},
/**
 * @desc Get the nonce from the url, the nonce must be of style _wpnonce=hdfdh465675,i.e. the name as _wpnonce
 */
get_nonce:function(url){
    return BpGalleryHelper.get_var_in_url(url,"_wpnonce");
},
/**
 * @desc Hide and show the Dom Elements
 */
hide_and_show:function(el,html){
    jQuery(el).hide('slow',function(){
         jQuery(el).empty();
        });
     jQuery(el).show('slow',function(){
            jQuery(el).html(html);
     } );
},
is_flash_enabled:function(){
    
   if(FlashDetect.installed&&(!!gallery_enable_flash_uploader))
       return true;
   return false;

},
 build_media_html: function(media){
 var html="<div class='media'><h3>"+media.title+"</h3>\n";
     html+=media.thumb;//we have the linked image
     html+="</div>";
  return html;
 }
    
}
//end of helper object


jQuery(document).ready( function() {
var helper=BpGalleryHelper;

var j = jQuery;
//activate sortable, required for activating sortable when the sorting page is directly opened
if(j("#gallery-sortable").get(0))
    j("#gallery-sortable").sortable({opacity: 0.6, cursor: 'move'});

 /**
  * @desc Build Media HTML for gallery
  */
 function build_media_html(media){
 var html="<div class='media'><h3>"+media.title+"</h3>\n";
     html+=media.thumb;//we have the linked image
     html+="</div>";
  return html;
 }
/**
 * @desc delete gallery, remove from dom
 */
function delete_gallery(gallery_id){
   //remove the gallery from parent
   var gdiv="gallery_"+gallery_id;
   j("#"+gdiv).remove();
}

/**
 * @desc make the media editable inline
 */
function make_media_editable(media,type){
    j(".media-content",media).hide();
    j("form",media).show();
    return false;
}

/**
 * @desc delete media from dom
 */
function delete_media(id){
var media_div="#gallery_media_"+id;
    j(media_div).remove();
}
/**
 * @desc Update the dom element for media
*/
function replace_media(media,mdiv){
   j(".media-title",mdiv).html(media.title);
   j(".media-description",mdiv).html(media.description);
   j("form",mdiv).hide();
   j(".media-content",mdiv).show('fast');
   helper.show_message(media.msg);
}


/**** end of helper functions for swf upload ****/



/*------------------------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------*/

/**
 * This section deals with gallery creation,
 * Gallery Editing
 * Gallery Deletion and so
 *
 */

/**
 *@desc Load Gallery Creation form via ajax
 */

j("#gallery_create,#add_new_gallery_link").live('click',
    function() {
        var url = j(this).attr('href');//get the url
        j.post( ajaxurl, {
                action: 'show_gallery_create_form',
                'cookie': encodeURIComponent(document.cookie),
                'component':cur_component,
                'component_id':cur_component_id,
		'_wpnonce': helper.get_nonce(url)
                },
		function(response){
                    j("#galleries").fadeOut(200,
                	function() {
			    j("#galleries").html(response);
                            j("#galleries").fadeIn(200);//change for wp3
                            j.scrollTo( j('form#gallery_create_form input#gallery_save'), 1000, {offset:-380, easing:'easeOutQuad'} );
                            }
                        );
		});
		
	return false;
});

/**
 * @desc Process gallery creation, Save the gallery data to database
 */
j("#gallery_save").live('click',
	function() {
            //disable the create button and text fields
            var button = j(this);
            var form = j("form#gallery_create_form");  //button.parent().parent().parent().parent();

		j("input,textarea",form).each( function() {
                    if ( j.nodeName(this, "textarea") || j.nodeName(this, "input") )
				j(this).attr( 'disabled', 'disabled' ); 
		});

		j( 'form#' + form.attr('id') + ' span.ajax-loader' ).show();
            j.post(ajaxurl, {
                action: 'gallery_create_save',
                "cookie": encodeURIComponent(document.cookie),
                "gallery_title":j("#gallery_create_form #title").val(),
                "gallery_status":j("#gallery_create_form #gallery_status").val(),
                "gallery_description":j("#gallery_create_form #gallery_description").val(),
                "gallery_type":j("#gallery_create_form #gallery_type").val(),
                "component":cur_component,
                "component_id":cur_component_id,
		"_wpnonce":j("#gallery_create_form input#_wpnonce-gallery_create_save").val()

			},
          function (response){
              //parse the response
              resp=JSON.parse(response);
              j( 'form#' + form.attr('id') + ' span.ajax-loader' ).hide();

			j("input,textarea",form).each( function() {
                    if ( j.nodeName(this, "textarea") || j.nodeName(this, "input") )
				j(this).attr( 'disabled', '' );
                            });
                        button.attr("disabled", '');
                
              if(resp.error!=undefined)
                  helper.show_message(resp.error.msg,1);
              else{
                  //redirect to the upload page
                  var gallery=resp.data;
                 //bring the upload form 
                 //redirect page to upload image
                 window.location.replace(gallery.add_media_link);
               }
             }

        );

  return false;

});


/***
 * For Single Gallery editing
 * */
j("#gallery_gallery_edit,.gallery-actions a.edit").live('click',function(){
    //if edit link was clicked,
    var url = j(this).attr('href');
    var gid=helper.get_var_in_url(url,'gallery_id');
    var nonce = helper.get_nonce(url);
    j.post(ajaxurl,{
                 action:"single_gallery_edit",
                 cookie:encodeURIComponent(document.cookie),
                 'gallery_id':gid,
                 '_wpnonce':nonce
                  },
                function(response){
                j("#galleries").fadeOut(200,
		 function() {
			
			j("#galleries").html(response);//do not prepend just remove the all other things
                        j("#galleries").fadeIn(200);//j('.gallery-cover')
                        j.scrollTo( j("#galleries"), 500, {offset:-50, easing:'easeOutQuad'} );
			}
		);
                    
             });
return false;
});


/**
 *For Single Gallery Media editing**/

j("#gallery-media-edit").live("click",function(){
    
    var url = j(this).attr('href');
    var gid=helper.get_var_in_url(url,'gallery_id');
    var nonce = helper.get_nonce(url);
    j.post( ajaxurl, {
		action: 'show_media_edit_form',
		'cookie': encodeURIComponent(document.cookie),
                'gallery_id':gid,
		'_wpnonce': nonce
		},
	   function(response){
                var p="#galleries";
		j(p).fadeOut(200,
		      function() {
                        j(p).html(response);//do not prepend just remove the all other things
                        j(p).fadeIn(200);//wp3
                        
                        j.scrollTo( j(p), 500, {offset:-50, easing:'easeOutQuad'} );
			}
		    );
       });
    
    return false;
});

//load add from web form
j("#gallery_media_add_from_web,.gallery-actions a.add-web").live("click",function(){

    var url = j(this).attr('href');
    var gid=helper.get_var_in_url(url,'gallery_id');
    var nonce = helper.get_nonce(url);
    j.post( ajaxurl, {
		action: 'show_media_add_from_web_form',
		'cookie': encodeURIComponent(document.cookie),
                'gallery_id':gid,
		'_wpnonce': nonce
		},
	   function(response){
                var p="#galleries";
		j(p).fadeOut(200,
		      function() {
                        j(p).html(response);//do not prepend just remove the all other things
                        j(p).fadeIn(200);//wp3

                        j.scrollTo( j(p), 500, {offset:-50, easing:'easeOutQuad'} );
			}
		    );
       });

    return false;
});

/**
 *For Drag and Drop Media Reordering
 */
j("#gallery_media_organize").live('click',function(){
 var url = j(this).attr('href');
 var gid=helper.get_var_in_url(url,'gallery_id');
 var nonce = helper.get_nonce(url);
 j.post( ajaxurl, {
	action: 'show_media_reorder_form',
	'cookie': encodeURIComponent(document.cookie),
        'gallery_id':gid,
	'_wpnonce': nonce
	},
     function(response){
           var p="#galleries";
	   j(p).fadeOut(200,
	     function() {
		j(p).html(response);//do not prepend just remove the all other things
                j(p).fadeIn(200);//wp3
                j.scrollTo( j(p), 500, {offset:-50, easing:'easeOutQuad'} );
                j("#gallery-sortable").sortable({opacity: 0.6, cursor: 'move'});
	    }
	);
    });
return false;
});

/***** For  The reordering of media inside a gallery*/

j("#gallery_media_rorder_form input[type='submit']").live('click',function(){
   helper.hide_message();
   var nonce=j("input#_wpnonce-gallery_media_reorder").val();
   var gallery_id=j("input#reorder_gallery_id").val();
   var data=j("#gallery-sortable").sortable("serialize")+"&_wpnonce="+nonce+"&gallery_id="+gallery_id+"&action=reorder_gallery_media&cookie="+ encodeURIComponent(document.cookie);
   j.post( ajaxurl, data,
            function(response){
                resp=JSON.parse(response);
                if(resp.error!=undefined)
                         helper.show_message(resp.error.msg,1);
                 else
                     helper.show_message(resp.msg,0);

	      });
  
    return false;
});

/**
 * @desc Delete gallery using ajax
 */
 j(".gallery-actions a.delete,#gallery_gallery_delete").live('click',
        function() {
	    var url = j(this).attr('href');
            var gid=helper.get_var_in_url(url,'gallery_id');
	    var nonce = helper.get_nonce(url);
            if(confirm(bp_gallery_js_terms.delete_gallery_confirm_message)){//to be translated
		j.post( ajaxurl, {
			action: 'delete_gallery',
			'cookie': encodeURIComponent(document.cookie),
                        'gallery_id':gid,
			'_wpnonce': nonce
			},
		   function(response){
                      response=JSON.parse(response);
                      delete_gallery(response.data.id);
                      helper.show_message(response.data.msg);
                      window.location.replace(gallery_home_url);//send user back to gallery home
			});
            }
			return false;
    }
);

/**
 * @desc Save gallery data inline On Single gallery editing Page
 **/

j("form#gallery_edit_info input[type='submit']").live("click",function(){
   helper.hide_message();//hide any message shown earlier
   var gallery_edit_form=j("form#gallery_edit_info");
   var gdiv=j(".edit-gallery",gallery_edit_form).get(0);//the gallery div
   var id=helper.get_id(gdiv);//get the id of this gallery /the actual content of gallery

 j.post( ajaxurl, {
		'action': 'inline_update_gallery',
                'gallery_id':id,
		'cookie': encodeURIComponent(document.cookie),
                'gallery_title':j("#gallery_title",gdiv).val(),
                'gallery_status':j("#gallery_status",gdiv).val(),
                'gallery_description':j("#gallery_description",gdiv).val(),
		'_wpnonce':j("#_wpnonce-edit-save-gallery",gdiv).val()

			},
            function(response){
               response=JSON.parse(response);
               if(response.error!=undefined){
                  helper.show_message(response.error.msg,1);//error message should be shown
                  return false;
                }
                //if we are here..there were no error..so we can proceed
        	var gallery=response.data;
                helper.show_message(gallery.msg,0);
         
	});
  return false;
});

j("#media_bulk_edit_form input[type='submit']").live('click',function(){
    var data=j("#media_bulk_edit_form").serialize();
    data+="&action=bulk_media_update&cookie="+encodeURIComponent(document.cookie);
    j.post( ajaxurl, data,
            function(response){
                response=JSON.parse(response);
                if(response.error!=undefined)
                    helper.show_message(response.error.msg,1);
                else
                    helper.show_message(response.msg,0);
	      });

 return false;
    
});



/*****************************Inline media operations*****************/

/**
 * Editing media Inline
 */
/**
 * @desc Make the media editable
 * */
 j(".bp-media .edit-delete a.edit").live('click',
		function() {
            var media = j(this).parent().parent().parent().get(0);
             make_media_editable(media);
           return false;
        });

//cancel media edit operation

j(".bp-media .media-inline-actions .cancel").live("click",function(){
    var media=j(this).parent().parent().parent().get(0);
    j("form",media).hide();
    j(".media-content",media).show();

    // hide_and_show(gdiv,html);


    return false;
});
/**
 * @desc Save media Information
 *
 * */
j(".bp-media .media-inline-actions .save").live("click",function(){
    var media=j(this).parent().parent().parent().get(0);//the gallery div
    var id=helper.get_id(media);//get the id of this media
 //so we have media id now build a request object
j.post( ajaxurl, {
				'action': 'inline_update_media',
                'media_id':id,
				'cookie': encodeURIComponent(document.cookie),
                'media_title':j("#media_title",media).val(),
                'media_status':j("#gallery_status",media).val(),//needs change
                'media_description':j("#media_description",media).val(),
				'_wpnonce':j("#_wpnonce-edit-save-media",media).val()

			},
function(response){
             response=JSON.parse(response);
             if(response.error!=undefined){
                     helper.show_message(response.error.msg,1);
                        return false;
                }
           replace_media(response.data,media);
       		 
			});
     return false;
});

/**
 * Deleting media inline
 */
j(".bp-media .edit-delete a.delete").live("click",function(evt){

var media_div=j(this).parent().parent().parent().get(0);

var id=helper.get_id(media_div);
var url=j(this).attr("href");
var nonce=helper.get_nonce(url);
j.post( ajaxurl, {
				action: 'delete_media',
				'cookie': encodeURIComponent(document.cookie),
                'media_id':id,
				'_wpnonce': nonce
			},
			function(response){
                 response=JSON.parse(response);
                 if(!response.error){
                     delete_media(response.data.id)
                     helper.show_message(response.data.msg);}
                  else
                      helper.show_message(response.error.msg,1);
			});

   return false;
});

/*** Pretty photo**/
//j(".media-linked").each(function(){
//
//var href=j(this).attr("href");
//href=href+"?pf=true&iframe=true&width=100%&height=100%";
//j(this).attr("href",href);
//
//});
//j(".media-linked").prettyPhoto();

/**
 * For Allowing User to post first comment to a media Item when the media item has no entry in the activity table
 * Thanks to @apeatling, this function is taken from bp-default/_inc/global.js but slightly modified
 */
j("input#gallery-new-comments-submit").live("click", function() {
		var button = j(this);
              	var form = button.parent().parent().parent().parent();

		form.children().each( function() {
			if ( j.nodeName(this, "textarea") || j.nodeName(this, "input") )
				j(this).attr( 'disabled', 'disabled' );
		});
		j( 'form#' + form.attr('id') + ' span.ajax-loader' ).show();

		/* Remove any errors */
		j('div.error').remove();
		button.attr('disabled','disabled');

		/* Default POST values */
		var object = '';
		var item_id = j("#whats-new-post-in").val();
		var content = j("textarea#whats-new").val();
                var current_component=j("#whats-new-post-object_component").val();
		/* Set object for non-profile posts */
		if ( item_id > 0 ) {
			object = j("#whats-new-post-object").val();
		}
                var is_single_media=j("#component-to-be-commented").val();
		j.post( ajaxurl, {
			action: 'gallery_post_update',
			'cookie': encodeURIComponent(document.cookie),
			'_wpnonce_post_update': j("input#_wpnonce_post_update").val(),
			'content': content,
			'object': object,
                        'component_type':current_component,
			'item_id': item_id,
                        'comment_parent':is_single_media,
                        'component_id': cur_component_id
		},
		function(response)
		{
			j( 'form#' + form.attr('id') + ' span.ajax-loader' ).hide();

			form.children().each( function() {
				if ( j.nodeName(this, "textarea") || j.nodeName(this, "input") )
					j(this).attr( 'disabled', '' );
			});

			/* Check for errors and append if found. */
			if ( response[0] + response[1] == '-1' ) {
				form.prepend( response.substr( 2, response.length ) );
				j( 'form#' + form.attr('id') + ' div.error').hide().fadeIn( 200 );
				button.attr("disabled", '');
			} else {
                            //hide the form
                            j(form).remove();
				if ( 0 == j("ul.activity-list").length ) {
					j("div.error").slideUp(100).remove();
					j("div#message").slideUp(100).remove();
					j("div.activity").append( '<ul id="activity-stream" class="activity-list item-list">' );
				}

				j("ul.activity-list").prepend(response);
				j("ul.activity-list li:first").addClass('new-update');
				j("li.new-update").hide().slideDown( 300 );
				j("li.new-update").removeClass( 'new-update' );
				j("textarea#whats-new").val('');

				/* Re-enable the submit button after 8 seconds. */
				setTimeout( function() {button.attr("disabled", '');}, 8000 );
			}
		});

		return false;
	});
    

/**
 * Publish Media to activity stream
 */

j("#publish_gallery_activity a").live('click',function(){
 var url = j(this).attr('href');
            var gid=helper.get_var_in_url(url,'gallery_id');
	    var nonce = helper.get_nonce(url);
            var action=helper.get_var_in_url(url,"publish");
            
       j.post( ajaxurl, {
			action: 'publish_gallery_to_activity',
			'cookie': encodeURIComponent(document.cookie),
                        'gallery_id':gid,
                        'publish_status':action,
			'_wpnonce': nonce

			},
		   function(response){
                       response=JSON.parse(response);
                        if(response.error!=undefined)
                             helper.show_message(response.error.msg,1);
                        else{
                            helper.show_message(response.msg,0);
                            j("#publish_gallery_activity").hide();
                        }
                     });
       	return false;

       });


});


