$(document).ready(function() {
    $( document ).on( 'click', 'button.change-share', function() {
        console.log( "change" );
        let type = $( this ).data( 'type' );
        let jml_saham = Number( $( 'input#acu-share' ).val() );
        let max_saham = Number( $( 'input#total_share' ).val() );
        if ( type == 'plus' ){
            jml_saham = jml_saham + 1;
            if ( jml_saham >= max_saham ){
                jml_saham = max_saham;
            }
        } else if ( type == 'min' ) {
            if ( jml_saham > 1 ){
                jml_saham = jml_saham - 1;
            } else {
                jml_saham = 1;
            }
        }
        hitung( jml_saham );
    });
    
    $( document ).on( 'change', 'input#acu-share', function() {
        let jml_saham = $( this ).val();
        let max_saham = Number( $( 'input#total_share' ).val() );
        if ( jml_saham == 0 ){
            jml_saham = 1;
        } else if ( jml_saham > max_saham ) {
            jml_saham = max_saham;
        }
        hitung( jml_saham )
    });
    
    function hitung( jml_saham ) {
        let nilai_saham = Number( $( 'input#value_per_share' ).val() );
        let yield_min = Number( $( '#text_yield_min' ).text() );
        let yield_max = Number( $( '#text_yield_max' ).text() );
        let nilai_investasi = jml_saham * nilai_saham;
        $( 'input#acu-share' ).val( jml_saham );
        $( '#nilai_investasi' ).html( nilai_investasi );
        $( '#text_profit_min' ).html( nilai_investasi * ( yield_min / 100 ) );
        $( '#text_profit_max' ).html( nilai_investasi * ( yield_max / 100 ) );
    }
    
    $( document ).on( 'click', 'button.change-buy', function() {
        let type = $( this ).data( 'type' );
        let jml_saham = Number( $( 'input#total_beli' ).val() );
        let max_saham = Number( $( 'input#total_share' ).val() );
        console.log( type );
        if ( type == 'plus_lot' ){
            jml_saham = jml_saham + 1;
            if ( jml_saham >= max_saham ){
                jml_saham = max_saham;
            }
        } else if ( type == 'min_lot' ) {
            if ( jml_saham > 1 ){
                jml_saham = jml_saham - 1;
            } else {
                jml_saham = 1;
            }
        }
         hitung_buy( jml_saham );
    });
    
    $( document ).on( 'change', 'input#total_beli', function() {
        let jml_saham = $( this ).val();
        let max_saham = Number( $( 'input#total_share' ).val() );
        if ( jml_saham == 0 ){
            jml_saham = 1;
        } else if ( jml_saham > max_saham ) {
            jml_saham = max_saham;
        }
        hitung_buy( jml_saham );
    });
    
    function hitung_buy( jml_saham ){
        let nilai_saham = Number( $( 'input#value_per_share' ).val() );
        let total_nominal = jml_saham * nilai_saham;
        let saldo_ewallet = Number( $( 'input#ewallet_saldo' ).val() );
        if ( total_nominal > saldo_ewallet ){
            jml_saham = Math.floor( saldo_ewallet / nilai_saham );
            total_nominal = jml_saham * nilai_saham;
        }
        $( 'input#total_beli' ).val( jml_saham );
        $( '#nominal_beli' ).html( total_nominal );
        $( 'input#input_nominal_beli' ).val( total_nominal );
    }

    $( document ).on( "click", "#beli_ecf", function(){
        $.ajax({
            url: $(this).attr( 'act' ),
            type: 'GET',
            dataType: 'html',
            beforeSend: function( xhr ) {
                
            },
            success : function( resp ) {
                $( '#modalContent' ).html( resp );
                $( '#modalForm' ).modal( 'show' );
            },
            error: function ( err ) {
                alert( err );
            }
        });
    });
    
    $( document ).on( "click", "#act_buy", function(){
        $.ajax({
            url: $(this).attr( 'act' ),
            type: 'POST',
            dataType: 'json',
            'data':{
                ecf_id: $( 'input[name="ecf_id"]').val(),
                total_beli: $( 'input#total_beli' ).val(),
                nominal_buy: $( 'input#input_nominal_beli' ).val()
            },
            beforeSend: function( xhr ) {
                
            },
            success : function( resp ) {
                if ( resp.status ) {
                    $( '#modalForm' ).modal( 'hide' );
                    $( '#modalContent' ).empty();
                    $( '#form_area' ).slideUp( 'slow' );
					$( '#table_area' ).slideDown( 'slow' );
					t.ajax.reload();
                    $( '#response_upload' ).html( resp.msg ).show().addClass( 'alert alert-success' );
                } else {
                    $( '#response_upload' ).html( resp.msg ).show().addClass( 'alert alert-danger' );
                }
                response_message
            },
            error: function ( err ) {
                alert( err );
            }
        });
    });
    
    $( document ).on( "click", "#act_close", function(){
        $( '#modalForm' ).modal( 'hide' );
        $( '#modalContent' ).empty();
    });
    
});