function add(com, grid, urlaction) {
	show_form( urlaction );
}

function add_xl(com, grid, urlaction) {
	show_form( urlaction, 1 );
}

function show_form( url, is_xl = null ){
	$.ajax({
		url:url,
		type: 'GET',
		dataType: 'html',
		beforeSend: function( xhr ) {
			$( '#table_area' ).slideUp( 'slow' );
			$( '#loader' ).slideDown( 'slow' );
		},
		success : function( data ) {
			$( '#loader' ).slideUp( 'slow' );
			$( '#form_area' ).html( data ).slideDown( 'slow' );
		},
		error: function ( err ) {
			$( '#loader' ).slideUp( 'slow', function(){
				$( '#form_area' ).html( err ).slideUp( 'slow' ).show();
			});
		}
	});
}

$("#response_message").fadeTo(2000, 500).slideUp(500, function(){
	$("#response_message").slideUp(500);
});

$(document).ready(function() {

	$(document).on( 'click', '#btn_save', function() {
		$('#response_message').html('').hide().removeClass('alert alert-danger alert-success')
		$.ajax({
			url: $( '#form-data' ).attr( 'action' ),
			type: 'POST',
			dataType: 'json',
			data: $( '#form-data' ).serialize(),
			beforeSend: function( xhr ) {
				$( '#modalLoader' ).modal( 'show' );
			},
			success : function( data ) {
				if ( data.status == 200 ) {
					$( '#form_area' ).slideUp( 'slow' );
					$( '#table_area' ).slideDown( 'slow' );
					t.ajax.reload();
					$( '#response_message' ).html( data.msg ).show().addClass( 'alert alert-success' );
				} else if ( data.status == 201 ) {
					$( '#response_message' ).html(data.msg).show().addClass( 'alert alert-danger' );
				} else {
					alert( data.msg );
				}
			},
			error: function (err) {
				$('#response_message').html( err ).show().addClass( 'alert alert-danger' );
			}
		});
	});

	$(document).on( 'click', '.btn-edit, .btn-add, .btn-update, .btn-detail, .btn-form', function(){
		show_form( $(this).attr('act') );
	});

	$(document).on( 'click', '.btn-act', function(){
		$('#response_message').html('').hide().removeClass('alert alert-danger alert-success');
		let data = {};
		data[$( this ).attr( 'name' )] = true;
		data['item'] = $( this ).attr( 'data' );
		$.ajax({
			url: $( this ).attr( 'act' ),
			type: 'POST',
			dataType: 'json',
			data: data,
			beforeSend: function( xhr ) {
				$( '#modalLoader' ).modal( 'show' );
			},
			success : function( response ) {
				$( '#response_message' ).html( response.msg ).show().addClass( response.message_class );
				toast( response, true );
			},
			error: function (err) {
				$('#response_message').html( err ).show().addClass( 'alert alert-danger' );
			}
		});
	});

	$( '.btn-add, .btn-edit, .btn-form' ).on( 'click', function(){
		show_form( $(this).attr('act') );
	});

	$(document).on( 'click', 'button.btn-close', function(){
		$( '#form_area' ).slideUp( 'slow' );
		$( '#table_area' ).slideDown( 'slow' );
	});

	$( document ).on( 'change clear', 'input.cari, select.cari', function() {
		let that = this;
		$( '.cari' ).each( function( x ){
			let urut = parseInt( this.getAttribute( 'data-urut' ) );
			t.columns(urut).search( this.value );
		});
		t.columns().draw();
	});
});

(function( $ ) {
	$.fn.search = function( header ) {
		let row = `<tr class="r_search" style="background-color: #ececec;">`;
		$.each( header, function( x, y ){
			row += `<td style="padding:0.5rem;">`;
			if (  y.searchable  ) {
				if ( y.searchdata['type'] == 'option' ) {
					let select = `<option value="">Semua ${y.title}</option>`;
					if ( 'value' in y.searchdata ) {
						$.each( y.searchdata.value, function( k, v ){
							select += `<option value="${k}">${v}</option>`;
						});

					} else {
						select += `
							<option value="0">Disable</option>
							<option value="1">Enable</option>
						`;
					}
					row += `<p style="margin:0px;"><select class="cari form-control form-control-sm" data-urut="${x}">${select}</select></p>`;
				} else if ( y.searchdata['type'] == 'input' ) {
					row += `<p style="margin:0px;"><input class="cari form-control form-control-sm" placeholder="Pencarian ${y.title}" data-urut="${x}"></p>`;
				}
			}
			row += `</td>`;
		});
		row += `</tr>`;
		let id = $(this).attr( "id" );
		$( '#' + id + ' thead tr:first' ).after( row );
		//$( '#grid thead tr:first' ).after( row );
	};
}( jQuery ));

$.fn.dataTable.pipeline = function( opts ) {
	var conf = $.extend( {
		pages: 5,
		url: '',
		data: null,
		method: 'POST'
	}, opts );
	var cacheLower = -1;
	var cacheUpper = null;
	var cacheLastRequest = null;
	var cacheLastJson = null;

	return function( request, drawCallback, settings ) {
		var ajax          = false;
		var requestStart  = request.start;
		var drawStart     = request.start;
		var requestLength = request.length;
		var requestEnd    = requestStart + requestLength;

		if ( settings.clearCache ) {
			ajax = true;
			settings.clearCache = false;
		} else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
			ajax = true;
		} else if ( JSON.stringify( request.order ) !== JSON.stringify( cacheLastRequest.order ) ||
			JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
			JSON.stringify( request.search ) !== JSON.stringify( cacheLastRequest.search ) ) {
			ajax = true;
		}
		cacheLastRequest = $.extend( true, {}, request );
		if ( ajax ) {
			if ( requestStart < cacheLower ) {
				requestStart = requestStart - (requestLength*(conf.pages-1));
				if ( requestStart < 0 ) {
					requestStart = 0;
				}
			}
			cacheLower = requestStart;
			cacheUpper = requestStart + (requestLength * conf.pages);
			request.start = requestStart;
			request.length = requestLength*conf.pages;
			if ( typeof conf.data === 'function' ) {
				var d = conf.data( request );
				if ( d ) {
					$.extend( request, d );
				}
			} else if ( $.isPlainObject( conf.data ) ) {
				$.extend( request, conf.data );
			}
			settings.jqXHR = $.ajax( {
				"type":     conf.method,
				"url":      conf.url,
				"data":     request,
				"dataType": "json",
				"cache":    false,
				"success":  function ( json ) {
					cacheLastJson = $.extend(true, {}, json);
					if ( cacheLower != drawStart ) {
						json.data.splice( 0, drawStart-cacheLower );
					}
					if ( requestLength >= -1 ) {
						json.data.splice( requestLength, json.data.length );
					}
					drawCallback( json );
				}
			} );
		} else {
			json = $.extend( true, {}, cacheLastJson );
			json.draw = request.draw; // Update the echo for each response
			json.data.splice( 0, requestStart-cacheLower );
			json.data.splice( requestLength, json.data.length );
			drawCallback(json);
		}
	}
};

$.fn.dataTable.Api.register( 'clearPipeline()', function() {
	return this.iterator( 'table', function( settings ) {
		settings.clearCache = true;
	} );
});

function toast(res, autoclose = false){
	$('#toast').html(`
		<div class="alert-toast">
			<div class="box-toast bg-${((res.status) ? 'green' : 'red' )}-500 ">
				<span class="message-toast">${res.msg}
					<div class="close-toast"><i class="fa fa-times"></i></div>
				</span>
			</div>
		</div>
	`);
 	if(autoclose) {
  		setTimeout(() => {
			$('#toast').empty();
		}, 3000);
	}
};

$( document ).on( 'click', '.close-toast', function(){
	$( '#toast' ).empty();
});
