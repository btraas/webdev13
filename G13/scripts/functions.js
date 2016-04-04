
// The following functions are from external sources.
// https://intranet.devrygreenhouses.com/rc/js/devry-ui-functions.js


$.extend( // getOrCreateDialog() {{{
{
    /** Create DialogBox by ID
    *
    * @param { String } elementID
    */
    getOrCreateDialog: function( id )
    {
        $box = $('#' + id);
        if( !$box.length )
        {
            $box = $('<div id="' + id + '"><p></p></div>').hide().appendTo('body');
        }
        return $box;
    }
}); // }}}


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
        dialogClass     : '',
        closeOnEscape   : true,
    }

    $alert = $.getOrCreateDialog( 'alert' );

    // set message
    message = message.replace( /\n/g, '<br />' );
    $("p", $alert).html( '<div style="text-align:left;">' + message + '</div>' );

    // init dialog
    $alert.dialog( $.extend( {}, defaults, options ) );

	options = empty(options) ? defaults : options;

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
        dialogClass     : '',
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

	options = empty(options) ? defaults : options;

    var buttonWidth = ( typeof options.buttonWidth != 'undefined' ) ? options.buttonWidth : defaults.buttonWidth;

    $('#confirm').next()
        .removeClass( 'ui-widget-content' ).addClass( options.dialogClass ? options.dialogClass : defaults.dialogClass ).css( 'border', '0px' )
        .find('.ui-button').addClass('small_button').css( { 'width':buttonWidth, 'margin-left':'10px' } )
        .find('.ui-button-text').css( { 'padding-top':'2px' } );

    // Make sure dialog appears above other dialogs
    $('#confirm').closest('.ui-dialog').css( 'z-index', 10001 );

} // }}}

function convertTo24Hour(time)  // {{{
{
    var hours = parseInt(time.substr(0, 2));
    if(time.indexOf('am') != -1 && hours == 12) {
        time = time.replace('12', '0');
    }
    if(time.indexOf('pm')  != -1 && hours < 12) {
        time = time.replace(hours, (hours + 12));
    }
    return time.replace(/(\sam|\spm)/, '');
} // }}}
function empty(mixed_var) { // {{{
  //  discuss at: http://phpjs.org/functions/empty/
  // original by: Philippe Baumann
  //    input by: Onno Marsman
  //    input by: LH
  //    input by: Stoyan Kyosev (http://www.svest.org/)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Onno Marsman
  // improved by: Francesco
  // improved by: Marc Jansen
  // improved by: Rafal Kukawski
  //   example 1: empty(null);
  //   returns 1: true
  //   example 2: empty(undefined);
  //   returns 2: true
  //   example 3: empty([]);
  //   returns 3: true
  //   example 4: empty({});
  //   returns 4: true
  //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
  //   returns 5: false

  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, '', '0'];

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixed_var === emptyValues[i]) {
      return true;
    }
  }

  if (typeof mixed_var === 'object') {
    for (key in mixed_var) {
      // TODO: should we check for own properties only?
      //if (mixed_var.hasOwnProperty(key)) {
      return false;
      //}
    }
    return true;
  }

  return false;
} // }}}

function getCookie(cname) { // {{{ from w3schools
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
} // }}}

function readCookie(name) { // {{{
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
} // }}}

