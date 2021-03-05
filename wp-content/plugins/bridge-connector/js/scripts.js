jQuery(document).ready(function($) {

  var SELF_PATH = 'plugins.php?page=connector-config&connector_action=';

  var messages = $('#messages');

  var installationsText = $('#connector-installed-txt');
  var contentBlockManage = $('#content-block-manage');

  var showButton = $("#showButton");
  var bridgeStoreKey = $('#bridgeStoreKey');
  var storeKey = $('#storeKey');
  var storeBlock = $('.store-key');
  var classMessage = $('.message');
  var progress = $('.progress');

  var timeDelay = 500;

  var bridgeConnectionInstall   = $("#bridgeConnectionInstall");
  var bridgeConnectionUninstall = $("#bridgeConnectionUninstall");

  var updateBridgeStoreKey = $('#updateBridgeStoreKey');

  if (showButton.val() == 'install') {
    installationsText.show();
    contentBlockManage.hide();
    storeBlock.fadeOut();
    updateBridgeStoreKey.hide();
    bridgeConnectionUninstall.hide();
    bridgeConnectionInstall.show();
  } else {
    installationsText.hide();
    contentBlockManage.show();
    storeBlock.fadeIn();
    updateBridgeStoreKey.show();
    bridgeConnectionInstall.hide();
    bridgeConnectionUninstall.show();
  }

  function statusMessage(message, status) {
    if (status == 'success') {
      classMessage.removeClass('bridge_error');
    } else {
      classMessage.addClass('bridge_error');
    }
    classMessage.html('<span>' + message + '</span>');
    classMessage.fadeIn("slow");
    classMessage.fadeOut(5000);
    var messageClear = setTimeout(function(){
      classMessage.html('');
    }, 3000);
    clearTimeout(messageClear);
  }

  $('.btn-setup').click(function() {
    var self = $(this);
    $(this).attr("disabled", true);
    progress.slideDown("fast");
    var install = 'install';
    if (showButton.val() == 'uninstall') {
      install = 'remove';
    }

    $.ajax({
      cache: false,
      url: SELF_PATH + install + 'Bridge',
      dataType: 'json',
      success: function(data) {
        self.attr("disabled", false);
        progress.slideUp("fast");
        if (install == 'install') {
          if (data.status != true) {
            statusMessage('Can not install Connector','error');
            return;
          }
          updateStoreKey(data.data.storeKey);
          installationsText.fadeOut(timeDelay);
          contentBlockManage.delay(timeDelay).fadeIn(timeDelay);
          storeBlock.fadeIn("slow");
          updateBridgeStoreKey.fadeIn("slow");
          showButton.val('uninstall');
          bridgeConnectionInstall.hide();
          bridgeConnectionUninstall.show();
          statusMessage('Connector Installed Successfully','success');
        } else {
          if (data.status != true) {
            statusMessage('Can not uninstall Connector','error');
            return;
          }
          contentBlockManage.fadeOut(timeDelay);
          installationsText.delay(timeDelay).fadeIn(timeDelay);
          storeBlock.fadeOut("fast");
          updateBridgeStoreKey.fadeOut("fast");
          showButton.val('install');
          bridgeConnectionUninstall.hide();
          bridgeConnectionInstall.show();
          statusMessage('Connector Uninstalled Successfully','success');
        }
      }
    });
  });

  updateBridgeStoreKey.click(function() {
    $.ajax({
      dataType: 'json',
      cache: false,
      url: SELF_PATH +'updateToken',
      success: function(data) {
        if (data.status != true) {
          statusMessage('Can not update Connector','error');
          return;
        }
        updateStoreKey(data.data.storeKey);
        statusMessage('Connector Updated Successfully!','success');
      }
    });
  });

  function updateStoreKey(store_key){
    storeKey.html(store_key);
  }

});