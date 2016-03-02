/** Improved alert() using a jQuery-UI Dialog box {{{
*
*	Usage:
*       alertDialog( "This is some alert message", { 'title': 'Did you know?' } );
*
*   Note:
*       Unlike confirm(), this dialog is Asynchronous.  It will NOT halt JS execution.
*
* @depends $.getOrCreateDialog
*
* @param { String } the alert message
* @param { Object } jQuery Dialog box options
*/
function alertDialog( message, options )
{
    // NOTE:    These are the default options.  Many more can be set (i.e. height, width, title, position, Class, etc.)
    //          For more info, see http://api.jqueryui.com/dialog/
    var defaults = {
        title           : "Alert Message",
        modal           : true,
        resizable       : false,
        buttons         :
        {
            OK          : function()
            {
                $(this).dialog('close');
            }
        },
        focus           : function()
        {
            $('#alert').next().find('button:eq(0)').addClass('ui-state-default').focus();
        },
        show            : 'fade',
        hide            : 'fade',
        minHeight       : 50,
        width           : 300,
        dialogClass     : 'ui-state-highlight',
        closeOnEscape   : true,
    }

    $alert = $.getOrCreateDialog( 'alert' );

    // set message
    message = message.replace( /\n/g, '<br />' );
    $("p", $alert).html( '<div style="text-align:left;">' + message + '</div>' );

    // init dialog
    $alert.dialog( $.extend( {}, defaults, options ) );

    $('#alert').next()
        .removeClass( 'ui-widget-content' ).addClass( options.dialogClass ? options.dialogClass : defaults.dialogClass ).css( 'border', '0px' )
        .find('.ui-button').addClass('small_button').css( { 'width':'70px', 'margin-left':'10px' } )
        .find('.ui-button-text').css( { 'padding-top':'2px' } );

    // Make sure dialog appears above other dialogs
    $('#alert').closest('.ui-dialog').css( 'z-index', 10001 );

} // }}}

/** Improved confirm() using a jQuery-UI Dialog box {{{
*
*   Usage:
*       confirmDialog( "Are you sure?", { 'title': 'Please confirm' }, function() { console.log( "User clicked OK!" ); }, function() { console.log( "User clicked cancel" ); } );
*       confirmDialog( 'The message', { 'title': 'The Title', 'button1Label': 'Yes', 'button2Label': 'No' }, function() { alert( 'Yes' ); }, function() { alert( 'No' ); } );
*
*   Note:
*       Unlike confirm(), this dialog is Asynchronous.  It will NOT halt JS execution, which is why the callbacks are required.
*
*       See js/jquery.dataTables.FilterMgr.js for an example of a using confirmDialog() as a quick/easy   ---->TODO INPUT DIALOG TODO <----.
*
* @depends $.getOrCreateDialog
*
* @param { String } the alert message
* @param { String/Object } the confirm callback
* @param { Object } jQuery Dialog box options
*/
function confirmDialog( message, options, callback1, callback2, callback3, callback4 )
{
    // NOTE:    These are the default options.  Many more can be set (i.e. height, width, title, position, Class, etc.)
    //          For more info, see http://api.jqueryui.com/dialog/

    var defaults = {
        title           : "Are you sure?",
        modal           : true,
        resizable       : false,
        buttonWidth     : '70px',
        button1Label    : 'OK',
        button2Label    : 'Cancel',
        button3Label    : null,
        button4Label    : null,
        buttons         :
        [
            {
                text    : !empty( options.button1Label ) ? options.button1Label : 'OK',
                click   : function()
                {
                    $(this).dialog('close');
                    return (typeof callback1 == 'string') ?  window.location.href = callback1 : callback1();
                }
            },
            {
                text    : !empty( options.button2Label ) ? options.button2Label : 'Cancel',
                click   : function()
                {
                    $(this).dialog('close');
                    if( !empty( callback2 ) )
                        return (typeof callback2 == 'string') ?  window.location.href = callback2 : callback2();
                    return false;
                }
            },
            {
                text    : !empty( options.button3Label ) ? options.button3Label : null,
                click   : function()
                {
                    $(this).dialog('close');
                    if( !empty( callback3 ) )
                        return (typeof callback3 == 'string') ?  window.location.href = callback3 : callback3();
                    return false;
                }
            },
            {
                text    : !empty( options.button4Label ) ? options.button4Label : null,
                click   : function()
                {
                    $(this).dialog('close');
                    if( !empty( callback4 ) )
                        return (typeof callback4 == 'string') ?  window.location.href = callback4 : callback4();
                    return false;
                }
            }
        ],
        focus           : function()
        {
            // Make the last button the default
            $('#confirm').next().find('button:eq(0)').blur();
            $('#confirm').next().find('button').last().addClass('ui-state-default').focus();
        },
        show            : 'fade',
        hide            : 'fade',
        minHeight       : 50,
        width           : 300,
        dialogClass     : 'ui-state-highlight',
        closeOnEscape   : true,
    }

    $confirm = $.getOrCreateDialog( 'confirm' );

    // set message
    message = message.replace( /\n/g, '<br />' );
    $("p", $confirm).html( '<div style="text-align:left;">' + message + '</div>' );


    // If user doesn't want a 3rd button, then remove it (and the 4th) from the default collection
    if( empty( options.button3Label ) ) defaults.buttons.splice( 2, 2 );

    // If user doesn't want a 4th button, then remove it from the default collection
    else if( empty( options.button4Label ) ) defaults.buttons.splice( 3, 1 );


    // init dialog
    $confirm.dialog( $.extend( {}, defaults, options ) );


    var buttonWidth = ( typeof options.buttonWidth != 'undefined' ) ? options.buttonWidth : defaults.buttonWidth;

    $('#confirm').next()
        .removeClass( 'ui-widget-content' ).addClass( options.dialogClass ? options.dialogClass : defaults.dialogClass ).css( 'border', '0px' )
        .find('.ui-button').addClass('small_button').css( { 'width':buttonWidth, 'margin-left':'10px' } )
        .find('.ui-button-text').css( { 'padding-top':'2px' } );

    // Make sure dialog appears above other dialogs
    $('#confirm').closest('.ui-dialog').css( 'z-index', 10001 );

} // }}}


