yii.allowAction = function($e){
    var message =$e.data('confirm');
    return message === undifined || yii.confirm(message, $e);
};
yii.allowAction = function ($e) {
        var message = $e.data('confirm');
        return message === undefined || yii.confirm(message, $e);
    };
    yii.confirm = function (message, ok, cancel) {

    bootbox.confirm(
        {
            message: message,
            buttons: {
                confirm: {
                    label: "<i class='fa fa-trash'></i> Hapus",
                    className: "btn-danger btn-raised"
                },
                cancel: {
                    label: "<i class='fa fa-close'></i> Batal",
                    className: "btn-default btn-raised"
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
};

$(document).ready(function(){
    $.material.init();
});
